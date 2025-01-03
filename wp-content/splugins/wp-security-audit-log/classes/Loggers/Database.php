<?php
/**
 * Class: Logger
 *
 * Logger class for wsal.
 *
 * @since 1.0.0
 * @package wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loggers Class.
 *
 * This class stores the logs in the database and there is also the function to clean up alerts.
 *
 * @package wsal
 * @subpackage loggers
 */
class WSAL_Loggers_Database extends WSAL_AbstractLogger {

	/**
	 * Method: Constructor.
	 *
	 * @param WpSecurityAuditLog $plugin - Instance of WpSecurityAuditLog.
	 * @since 1.0.0
	 */
	public function __construct( WpSecurityAuditLog $plugin ) {
		parent::__construct( $plugin );
		$plugin->AddCleanupHook( array( $this, 'CleanUp' ) );
	}

	/**
	 * Checks is the connection is for an external database.
	 *
	 * @since 4.3.2
	 * @return boolean
	 */
	public function is_external() {
		$db_config = WSAL_Connector_ConnectorFactory::GetConfig();

		return is_array( $db_config ) && ! empty( $db_config );
	}

	/**
	 * Log an event to the database.
	 *
	 * There is no difference between local and external database handling os of version 4.3.2.
	 *
	 * @param integer $type            - Alert code.
	 * @param array   $data            - Metadata.
	 * @param integer $date            - (Optional) created_on.
	 * @param integer $site_id          - (Optional) site_id.
	 */
	public function Log( $type, $data = array(), $date = null, $site_id = null ) {
		//  PHP alerts logging was deprecated in version 4.2.0
		if ( $type < 0010 ) {
			return;
		}

		// Create new occurrence.
		$occ              = new WSAL_Models_Occurrence();
		$occ->created_on  = $this->get_correct_timestamp( $data, $date );
		$occ->alert_id    = $type;
		$occ->site_id     = ! is_null( $site_id ) ? $site_id : ( function_exists( 'get_current_blog_id' ) ? get_current_blog_id() : 0 );

		//  we need to remove the timestamp to prevent from saving it as meta
		unset( $data['Timestamp'] );

		// Get DB connector.
		$db_config = WSAL_Connector_ConnectorFactory::GetConfig(); // Get DB connector configuration.

		// Get connector for DB.
		$connector  = $this->plugin->getConnector( $db_config );
		$wsal_db    = $connector->getConnection(); // Get DB connection.
		$connection = true;
		if ( isset( $wsal_db->dbh->errno ) ) {
			$connection = ( 0 === (int) $wsal_db->dbh->errno ); // Database connection error check.
		} elseif ( is_wp_error( $wsal_db->error ) ) {
			$connection = false;
		}

		// Check DB connection.
		if ( $connection ) { // If connected then save the alert in DB.
			// Save the alert occurrence.
			$occ->Save();

			// Set up meta data of the alert.
			$occ->SetMeta( $data );
		} else {
			//  @todo write to a debug log
		}

		/**
		 * Fires immediately after an alert is logged.
		 *
		 * @since 3.1.2
		 */
		do_action( 'wsal_logged_alert', $occ, $type, $data, $date, $site_id );
	}

	/**
	 * Clean Up alerts by date OR by max number.
	 */
	public function CleanUp() {
		$now       = current_time( 'timestamp' );
		$max_sdate = $this->plugin->settings()->GetPruningDate();
		$max_count = $this->plugin->settings()->GetPruningLimit();
		$is_date_e = $this->plugin->settings()->IsPruningDateEnabled();
		$is_limt_e = $this->plugin->settings()->IsPruningLimitEnabled();

		// Return if retention is disabled.
		if ( ! $is_date_e && ! $is_limt_e ) {
			return;
		}


		$occ       = new WSAL_Models_Occurrence();
		$cnt_items = $occ->Count();

		// Check if there is something to delete.
		if ( $is_limt_e && ( $cnt_items < $max_count ) ) {
			return;
		}

		$max_stamp = $now - ( strtotime( $max_sdate ) - $now );
		$max_items = (int) max( ( $cnt_items - $max_count ) + 1, 0 );

		$query = new WSAL_Models_OccurrenceQuery();
		$query->addOrderBy( 'created_on', false );
		// TO DO: Fixing data.
		if ( $is_date_e ) {
			$query->addCondition( 'created_on <= %s', intval( $max_stamp ) );
		}
		if ( $is_limt_e ) {
			$query->setLimit( $max_items );
		}

		if ( ( $max_items - 1 ) == 0 ) {
			return; // Nothing to delete.
		}

		$result        = $query->getAdapter()->GetSqlDelete( $query );
		$deleted_count = $query->getAdapter()->Delete( $query );

		if ( 0 == $deleted_count ) {
			return; // Nothing to delete.
		}

		// Notify system.
		do_action( 'wsal_prune', $deleted_count, vsprintf( $result['sql'], $result['args'] ) );
	}
}
