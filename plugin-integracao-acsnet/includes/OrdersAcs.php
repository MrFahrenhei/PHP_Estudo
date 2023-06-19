<?php

namespace PIACS;
use \Exception;
use PIACS\OrderCallbacks;
use PIACS\Settings;
use PIACS\Database;
use PIACS\Nfe;

defined( 'ABSPATH' ) || exit;

class OrdersAcs{
	private $orders = null;

	function __construct(){
		return $this->load();
	}

	public function getOrders(){
		return $this->orders;
	}

	private function load($forceNew = false){
		if(!$forceNew && (!is_null($this->orders)))
			return $this->orders;

		$orders = array();

		foreach (Database::getAcsOrders() as $obj) {
			try{
			  	$obj->order 		= wc_get_order($obj->order_id);
			  	$obj->orderType 	= OrderCallbacks::getOrderType();
			  	$obj->Nfe 			= new Nfe($obj->order_id, true);

			  	$orders[] = $obj;
			} catch (Exception $e) {
				continue;	
			}
		}  

		$this->orders = $orders;

		return $this->orders;
	}

	public function processa(){
		foreach ($this->orders as $order) {
			try {
				$obj = new Order($order->get_data());
				$obj->exec();
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), true);
				
			}
		}
	}


}