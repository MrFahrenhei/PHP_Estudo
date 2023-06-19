<?php

namespace PIACS;
use PIACS\Oauth2;
use PIACS\Database;
use PIACS\Product;
use PIACS\Settings;
use PIACS\Logs;
use \Exception;

defined( 'ABSPATH' ) || exit;

class Integration{

	private $token = null;

	public function __construct(){
		$con = new Oauth2();
		$this->token = $con->getToken();

	}

	public function exec(){


		$products = $this->requestProducts();

		ini_set('memory_limit', '-1');
		
		$i = 0;
		foreach ($products as $product){
			$i++;
			$tmp = new Product($product);
			$tmp->save();
			
			if($tmp->hasErrors())
				var_dump($tmp->getErrors());

			unset($tmp);
		}
		return $i;

	}

	private function explodeHeader($array){
		$result = array();
		foreach ($array as $value){
			$a = explode(":", $value);
			$result[$a[0]] = $a[1];
		}
		return $result;
	}

	public function submitOrder($order){
		ini_set('memory_limit', '-1');

		$curl = curl_init(Settings::get('order_url'));
		curl_setopt($curl, CURLOPT_URL, Settings::get('order_url'));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "accept: text/json",
		   "EstablishmentId: ". Settings::get('establishment'),
		   "Authorization: ". $this->token,
		   'Content-Type: application/json',
		);

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($order, JSON_PRETTY_PRINT));

		$response = curl_exec($curl);

		$req = array_merge(
				$this->explodeHeader($headers), 
				curl_getinfo($curl), 
				(array('POST' => $order))
			);

		Logs::register($req, $response, $curl);

		if($error = $this->getErrors($response, $curl))
			throw new Exception("<h4>Ocorreu um erro na Integração com o ACSNet</h4>". $error, true);
		
		curl_close($curl);

		$response = json_decode($response);

		if (isset($response->Message))
			throw new Exception($response->Message, true);

		if(!$response->Success)
			throw new Exception(implode('; ', $response->Errors), false);

		return $response;

	}



	public function requestProducts(){
		$curl = curl_init(Settings::get('get_url'));
		curl_setopt($curl, CURLOPT_URL, Settings::get('get_url'));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "accept: text/json",
		   "EstablishmentId: ". Settings::get('establishment'),
		   "Authorization: ". $this->token,
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($curl);

		$req = array_merge($this->explodeHeader($headers), curl_getinfo($curl));
		Logs::register($req, $response, $curl);

		if(curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200)
			throw new Exception("Erro ao requisitar o webservice!", true);
			

		$response = json_decode($response);

		if (isset($response->Message))
			throw new Exception($response->Message, true);

		curl_close($curl);
		return $response;
	}

	private function getErrors($response, $curl){

		if($error = curl_error($curl))
			return $error;

		$response = json_decode($response);

		if(isset($response->status) && $response->status !== 200){
			$message = "<b>". $response->title ."</b>\r\n";
			
			if(isset($response->status))
				$message .= 'Error Code: '. $response->status ."\r\n";

			if(isset($response->traceId))
				$message .= 'trace Id: '. $response->traceId ."\r\n";

			if(isset($response->errors))
				$message .= json_encode($response->errors) ."\r\n"; 

			return $message;
		}

		return false;
	}


	public function requestNfe($id, $type){
		ini_set('memory_limit', '-1');

		$params = array(
			'OrderId' 	=> $id,
			'OrderType' => $type,
		);

		$curl = curl_init(Settings::get('nfe_url') . '?' . http_build_query($params));
		curl_setopt($curl, CURLOPT_URL, Settings::get('nfe_url') . '?' . http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "accept: text/json",
		   "EstablishmentId: ". Settings::get('establishment'),
		   "Authorization: ". $this->token,
		   'Content-Type: application/json',
		);

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


		$response = curl_exec($curl);
		$req = array_merge(
				$this->explodeHeader($headers), 
				curl_getinfo($curl), 
				(array('GET' => $params))
			);

		Logs::register($req, $response, $curl);

		if($error = $this->getErrors($response, $curl))
			throw new Exception("<h4>Ocorreu um erro na Integração com o ACSNet</h4>". $error, true);
		
		curl_close($curl);

		$response = json_decode($response);

		if (isset($response->Message))
			throw new Exception($response->Message, true);

		if(!$response->Success)
			throw new Exception(implode('; ', $response->Errors), false);

		return $response;
	}



}
