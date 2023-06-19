<?php

namespace PIACS;
use \Exception;
use PIACS\Order;
use PIACS\Settings;

defined( 'ABSPATH' ) || exit;

class Orders{
	private $orders = null;

	function __construct(){
		$this->ordens = $this->load();

		$this->processa();
	}

	private function load($forceNew = false){
		if(!$forceNew && (!is_null($this->orders)))
			return $this->orders;

		$this->orders = wc_get_orders(
			array(
				'limit'=>-1,
				'type'=> 'shop_order',
				'status'=> array(Settings::get('cat_sub_order')),
			)
		);  

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