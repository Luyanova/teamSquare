<?php
/**
 * Adapter: Meta data.
 *
 * MySQL database Metadata class.
 *
 * @package wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MySQL database Metadata class.
 *
 * MySQL wsal_metadata table used for to store the alert meta data:
 * username, user_roles, client_ip, user_agent, post_id, post_title, etc.
 *
 * @package wsal
 */
class WSAL_Adapters_MySQL_Meta extends WSAL_Adapters_MySQL_ActiveRecord implements WSAL_Adapters_MetaInterface {

	/**
	 * Contains the table name.
	 *
	 * @var string
	 */
	protected $_table = 'wsal_metadata';

	/**
	 * Contains primary key column name, override as required.
	 *
	 * @var string
	 */
	protected $_idkey = 'id';

	/**
	 * Meta id.
	 *
	 * @var int
	 */
	public $id = 0;

	/**
	 * Occurrence id.
	 *
	 * @var int
	 */
	public $occurrence_id = 0;

	/**
	 * Meta name.
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Meta name max length.
	 *
	 * @var int
	 */
	public static $name_maxlength = 100;

	/**
	 * Meta value.
	 *
	 * @var mixed
	 */
	public $value = array(); // Force mixed type.

	/**
	 * @inheritDoc
	 *
	 * @return WSAL_Models_Meta
	 */
	public function GetModel() {
		$result = new WSAL_Models_Meta();
		$result->setAdapter( $this );

		return $result;
	}

	/**
	 * SQL table options (constraints, foreign keys, indexes etc).
	 *
	 * @return string
	 */
	protected function GetTableOptions() {
		return parent::GetTableOptions() . ',' . PHP_EOL
				. '    KEY occurrence_name (occurrence_id,name)';
	}

	/**
	 * @inheritDoc
	 */
	public function DeleteByOccurrenceIds( $occurrence_ids ) {
		if ( ! empty( $occurrence_ids ) ) {
			$sql = 'DELETE FROM ' . $this->GetTable() . ' WHERE occurrence_id IN (' . implode( ',', $occurrence_ids ) . ')';
			// Execute query.
			parent::DeleteQuery( $sql );
		}
	}

	/**
	 * @inheritDoc
	 */
	public function LoadByNameAndOccurrenceId( $meta_name, $occurrence_id ) {
		//  make sure to grab the migrated meta fields from the occurrence table
		if ( in_array( $meta_name, array_keys( WSAL_Models_Occurrence::$migrated_meta ) ) ) {
			$occurrence  = new WSAL_Adapters_MySQL_Occurrence( $this->get_connection() );
			$column_name = WSAL_Models_Occurrence::$migrated_meta[ $meta_name ];

			return $occurrence->$column_name;
		}

		return $this->Load( 'occurrence_id = %d AND name = %s', array( $occurrence_id, $meta_name ) );
	}

	/**
	 * Create relevant indexes on the metadata table.
	 */
	public function create_indexes() {
		$db_connection = $this->get_connection();
		// check if an index exists.
		$index_exists = false;
		if ( $db_connection->query( 'SELECT COUNT(1) IndexIsThere FROM INFORMATION_SCHEMA.STATISTICS WHERE table_schema=DATABASE() AND table_name="' . $this->GetTable() . '" AND index_name="name_value"' ) ) {
			// query succeeded, does index exist?
			$index_exists = ( isset( $db_connection->last_result[0]->IndexIsThere ) ) ? $db_connection->last_result[0]->IndexIsThere : false;
		}
		// if no index exists then make one.
		if ( ! $index_exists ) {
			$db_connection->query( 'CREATE INDEX name_value ON ' . $this->GetTable() . ' (name, value(64))' );
		}
	}
}
