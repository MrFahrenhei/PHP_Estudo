<?php

namespace PIACS;
use PIACS\Database;
use PIACS\Settings;
use \Exception;


defined( 'ABSPATH' ) || exit;

class Oauth2{
	private $token = null;

	public function __construct($new = false){

		if($new || is_null($this->token = Database::getToken()))
			$this->token = $this->conn();
		
	}

	private function conn(){
		$curl = curl_init();

		$fields = array(
			"grant_type=client_credentials",
			"client_id=". Settings::get('client_id'),
			"client_secret=". Settings::get('client_secret'),
			"scope=". Settings::get('scope'),
		);

		curl_setopt_array($curl, [
			CURLOPT_URL 			=> Settings::get('token_url'),
			CURLOPT_RETURNTRANSFER 	=> true,
			CURLOPT_ENCODING 		=> "",
			CURLOPT_MAXREDIRS 		=> 10,
			CURLOPT_TIMEOUT 		=> 30,
			CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST 	=> "POST",
			CURLOPT_POSTFIELDS 		=> implode("&", $fields),
			CURLOPT_HTTPHEADER 		=> [
				"content-type: application/x-www-form-urlencoded"
			],
		]);
		$response = curl_exec($curl);
		

		if($err = curl_error($curl))
			throw new Exception($err, true);

		$response = json_decode($response);


		if (isset($response->Message))
			throw new Exception($response->Message, true);

		$token = $response->token_type .' '. $response->access_token;

		Database::setToken($token, $response->expires_in);

		return $token;
	}

	public function getToken(){
		return $this->token;
	}


	



}

