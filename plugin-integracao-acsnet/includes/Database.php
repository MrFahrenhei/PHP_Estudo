<?php

namespace PIACS;
use \Exception;

defined( 'ABSPATH' ) || exit;

class Database{

	public static $plugin_prefix = 'piacs';

	protected function __construct(){
	}

	public static function getTableName($table){
		global $wpdb;
		return $wpdb->prefix . self::$plugin_prefix . "_" . $table;
	}

	public static function getTableSize($table){
		try {
			global $wpdb;

			$tablename = self::getTableName($table);

			$database = DB_NAME;

			$sql = "
				SELECT  data_length / 1024 / 1024 AS 'tam'
				FROM information_schema.tables 
				WHERE table_name LIKE '$tablename'
					AND table_schema LIKE '$database'
			";
	
			return round($wpdb->get_row($sql)->tam, 2);;
			 
		} catch (Exception $e) {
			return null;
		}
	}

	public static function dropTable($table){	    
		try {
			global $wpdb;

			$tablename = self::getTableName($table);

			$wpdb->query( "DROP TABLE IF EXISTS $tablename" );
			 
			return true;
		} catch (Exception $e) {
			return false;
		}
	}


	public static function createTable($table, $sql, $dropIfExist = false){
	    global $wpdb;
    
		$tablename = self::getTableName($table);

	    if ($dropIfExist)
	    	Database::dropTable($table);

	    elseif ( $wpdb->get_var( "SHOW TABLES LIKE '$tablename'" ) == $tablename )
	    	return;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta(str_replace('%table%', $tablename, $sql));
	}

	public static function getToken(){
		try {
			global $wpdb;

			$tablename = self::getTableName('tokens');

			$wpdb->query( "DELETE FROM $tablename WHERE life < now()" );
			$token = $wpdb->get_row("SELECT * FROM $tablename ORDER BY life DESC LIMIT 1");

			if(is_null($token))
				return null;

			return $token->token; 

		} catch (Exception $e) {
			return null;
		}
		
	}

	public static function getActiveCategories(){
		try {
			global $wpdb;

			$tablename = self::getTableName('active_categories');

			$result = $wpdb->get_results("SELECT * FROM $tablename", 'ARRAY_N');
			
			return call_user_func_array('array_merge', $result);


		} catch (Exception $e) {
			return null;
		}
		
	}

	public static function deactiveCategory($id){
		global $wpdb;
		$tablename = self::getTableName('active_categories');

		$wpdb->query( "DELETE FROM $tablename WHERE category_id = $id");
	}

	public static function activeCategory($id){
		global $wpdb;
		$tablename = self::getTableName('active_categories');

		$wpdb->query( "INSERT INTO $tablename SET category_id = $id");
	}


	public static function setToken($token, $life){

		global $wpdb;
		$tablename = self::getTableName('tokens');

		$life = (int) $life;
		$wpdb->query( "DELETE FROM $tablename WHERE life < now()" );
		$wpdb->query("INSERT INTO $tablename SET token = '". $token ."', life = DATE_ADD(now(), INTERVAL $life SECOND)");
	}

	public static function insert($table, $array){
		try {
			$list = array();
			foreach ($array as $key => $value){
				if(is_null($value))
					$list[] = "`". $key ."`= null";

				else
					$list[] = "`". $key ."`='". $value ."'";
			} 
			
			global $wpdb;
			$tablename = self::getTableName($table);
			$wpdb->query("REPLACE INTO $tablename SET ts = now(), ". implode(",", $list));
			return $wpdb->insert_id;
		} catch (Exception $e) {
			echo $e->getMessage() .'<br>';
			
		}
	}

	public static function getConfig($key){
		if($memConf = self::getConfigMemory($key))
			return $memConf;

		if(!($memPers = self::getConfigPersistence($key)))
			return false;

		$array = array();
		$array['key'] = $key;
		$array['value'] = $memPers;

		self::insert('configs_memory', $array);

		return $memPers;
		
	}

	public static function getConfigPersistence($key){
		try {		
			global $wpdb;

			$tablename = self::getTableName('configs');

			$config = $wpdb->get_row("SELECT * FROM $tablename WHERE `key` LIKE '$key'");

			if(is_null($config))
				return false;

			return $config->value; 

		} catch (Exception $e) {
			return false;
		}
	}

	public static function getConfigMemory($key){
		try {
			global $wpdb;

			$tablename = self::getTableName('configs_memory');

			$config = $wpdb->get_row("SELECT * FROM $tablename WHERE `key` LIKE '$key' AND `ts` > NOW() - INTERVAL 6 HOUR");

			if(is_null($config))
				return false;

			return $config->value; 

		} catch (Exception $e) {
			return false;
		}
		
	}	

	public static function clearConfigMemory(){
		try {		
			global $wpdb;

			$tablename = self::getTableName('configs_memory');

			$wpdb->get_row("DELETE FROM $tablename");

			return true;

		} catch (Exception $e) {
			return false;
		}
	}

	public static function deleteLogs($life){
		try {		
			global $wpdb;

			$tablename = self::getTableName('logs');

			$wpdb->get_row("DELETE FROM $tablename  WHERE ts < DATE_SUB(NOW(), INTERVAL $life DAY)");

			return true;

		} catch (Exception $e) {
			return false;
		}
	}


	public static function getLogs(){
		try {
			global $wpdb;

			$tablename = self::getTableName('logs');

			$logs = $wpdb->get_results("SELECT * FROM $tablename", OBJECT_K);

			if(is_null($logs))
				return array();

			return $logs; 

		} catch (Exception $e) {
			return false;
		}
	}

	public static function getAcsOrders(){
		try {
			global $wpdb;

			$tablename = self::getTableName('orders_id');

			$orders = $wpdb->get_results("SELECT * FROM $tablename ORDER BY order_id DESC", OBJECT_K);

			if(is_null($orders))
				return array();

			return $orders; 

		} catch (Exception $e) {
			return false;
		}
	}

	public static function getAcsOrder($orderId){
		try {
			global $wpdb;

			$tablename = self::getTableName('orders_id');

			return $wpdb->get_row("SELECT * FROM $tablename WHERE order_id LIKE '$orderId'")->acs_order_id;

		} catch (Exception $e) {
			return false;
		}
	}

	public static function getNfe($orderId){
		try {
			global $wpdb;

			$tablename = self::getTableName('nfe');

			return $wpdb->get_row("SELECT * FROM $tablename WHERE order_id = $orderId");

		} catch (Exception $e) {
			return false;
		}
	}

}







