<?php

namespace PIACS;
use PIACS\Database;
use PIACS\Settings;
use PIACS\Integration;
use \Exception;

defined( 'ABSPATH' ) || exit;

class Nfe{

	public static function clearOldCache(){
		Database::deleteCacheNfe(Settings::get('live_cache_nfe'), Settings::get('max_cache_nfe'));
	}

	private $id 			= null;
	private $order_id 		= null;
	private $Serial 		= null;
	private $NumberNfe 		= null;
	private $NumberOrder 	= null;
	private $DocXml 		= null;
	private $DocPdf 		= null;
	private $ts 			= null;

	private $hasCache 		= false;


	function __construct($orderId, $getAcs = false){

		$this->getCache($orderId);
		if($getAcs && !$this->hasCache()){
			$this->request($orderId);

			if($this->getOrderId() === null)
				return null;

			$this->save();
		}

	}

	private function save(){
		if($this->getOrderId() === null)
			throw new Exception("O id do pedido não pode ser null", True);


		$a = array();
		$a['Id'] 			= $this->getId();
		$a['order_id'] 		= $this->getOrderId();
		$a['Serial'] 		= $this->getSerial();
		$a['NumberNfe'] 	= $this->getNumberNfe();
		$a['NumberOrder'] 	= $this->getNumberOrder();
		$a['DocXml'] 		= $this->getDocXml();
		$a['DocPdf'] 		= $this->getDocPdf();

		try {
			$this->setId(Database::insert('nfe', $a));
			$this->hasCache = true;
			return true;
		} catch (Exception $e) {
			return false;
		}

	}

	private function getCache($orderId){
		$cache = Database::getNfe($orderId);
	
		$this->hasCache = !is_null($cache);
		if(!$this->hasCache())
			return;

		foreach ($cache as $key => $value){
			$this->{$key} = $value;
			if(is_null($value))
				$this->hasCache = False;

		} 
	}

	public function hasCache(){
		return $this->hasCache;
	}



	private function request($orderId){
		$acsId = Database::getAcsOrder($orderId);
		$type = OrderCallbacks::getOrderType();

		$con = new Integration();
		try {
			$response = $con->requestNfe($acsId, $type);
			if(!$response)
				throw new Exception("Webservice retornou NULL", True);
				

		$this->setOrderId($orderId);
		$this->setSerial($response->Serial);
		$this->setNumberNfe($response->NumberNfe);
		$this->setNumberOrder($response->NumberOrder);
		$this->setDocXml($response->DocXml);
		$this->setDocPdf($response->DocPdf);		



		} catch (Exception $e) {
			return;
		}

	}




	public function getId(){
		return $this->id;
	}

	private function setId($value){
		$this->id = $value;
	}	
	
	public function getOrderId(){
		return $this->order_id;
	}
	
	private function setOrderId($value){
		$this->order_id = $value;
	}

	public function getSerial(){
		return $this->Serial;
	}
	
	private function setSerial($value){
		$this->Serial = $value;
	}

	public function getNumberNfe(){
		return $this->NumberNfe;
	}

	private function setNumberNfe($value){
		$this->NumberNfe = $value;
	}
	
	public function getNumberOrder(){
		return $this->NumberOrder;
	}
	
	private function setNumberOrder($value){
		$this->NumberOrder = $value;
	}

	public function getDocXml(){
		return $this->DocXml;
	}
	
	private function setDocXml($value){
		$this->DocXml = $value;
	}

	public function getDocPdf(){
		return $this->DocPdf;
	}
	
	private function setDocPdf($value){
		$this->DocPdf = $value;
	}

	public function getTs(){
		return $this->ts;
	}
	




}