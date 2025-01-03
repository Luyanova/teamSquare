<?php
/**
 * Active Record Interface.
 *
 * Interface used by the ActiveRecord.
 *
 * @package wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Interface used by the ActiveRecord.
 *
 * @package wsal
 */
interface WSAL_Adapters_ActiveRecordInterface {

	/**
	 * Returns whether table structure is installed or not.
	 *
	 * @deprecated
	 * @return boolean
	 */
	public function IsInstalled();

	/**
	 * Install this ActiveRecord structure into DB.
	 */
	public function Install();

	/**
	 * Remove this ActiveRecord structure from DB.
	 */
	public function Uninstall();

	/**
	 * Load.
	 *
	 * @param string $cond - Query Condition.
	 * @param array  $args - Query arguments.
	 */
	public function Load( $cond = '%d', $args = array( 1 ) );

	/**
	 * Save an active record into DB.
	 *
	 * @param object $active_record - ActiveRecord object.
	 * @return integer|boolean - Either the number of modified/inserted rows or false on failure.
	 */
	public function Save( $activeRecord );

	/**
	 * Delete DB record.
	 *
	 * @param object $active_record - ActiveRecord object.
	 * @return int|boolean - Either the amount of deleted rows or False on error.
	 */
	public function Delete( $activeRecord );

	/**
	 * Load multiple records from DB.
	 *
	 * @param string $cond (Optional) Load condition (eg: 'some_id = %d' ).
	 * @param array $args (Optional) Load condition arguments (rg: array(45) ).
	 *
	 * @return self[] List of loaded records.
	 */
	public function LoadMulti( $cond, $args = array() );

	/**
	 * Load multiple records from DB and call a callback for each record.
	 * This function is very memory-efficient, it doesn't load records in bulk.
	 *
	 * @param callable $callback The callback to invoke.
	 * @param string   $cond (Optional) Load condition.
	 * @param array    $args (Optional) Load condition arguments.
	 */
	public function LoadAndCallForEach( $callback, $cond = '%d', $args = array( 1 ) );

	/**
	 * Count records in the DB matching a condition.
	 * If no parameters are given, this counts the number of records in the DB table.
	 *
	 * @param string $cond (Optional) Query condition.
	 * @param array  $args (Optional) Condition arguments.
	 * @return int Number of matching records.
	 */
	public function Count( $cond = '%d', $args = array( 1 ) );

	/**
	 * Similar to LoadMulti but allows the use of a full SQL query.
	 *
	 * @param string $query Full SQL query.
	 * @param array $args (Optional) Query arguments.
	 *
	 * @return array List of loaded records.
	 * @throws Exception
	 */
	public function LoadMultiQuery( $query, $args = array() );

	/**
	 * Returns the model class for adapter.
	 *
	 * @return WSAL_Models_ActiveRecord
	 */
	public function GetModel();
}
