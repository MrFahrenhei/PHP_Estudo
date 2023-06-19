<?php

namespace PIACS;
use PIACS\Database;
use PIACS\Settings;
use \Exception;

defined( 'ABSPATH' ) || exit;

class Logs{

	public static function register($req, $resp, $curl){
		$log = array();
		$log['request'] = json_encode($req, JSON_PARTIAL_OUTPUT_ON_ERROR + JSON_PRETTY_PRINT);
		$log['response'] = addslashes($resp);
		$log['code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		Database::insert('logs', $log);
	}

	function __construct(){
		$this->clearLogs();
	}

	private function clearLogs(){
		Database::deleteLogs(Settings::get('live_to_log'));
	}

	public function getAll(){
		return Database::getLogs();
	}

}