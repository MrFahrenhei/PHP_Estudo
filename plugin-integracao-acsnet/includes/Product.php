<?php

namespace PIACS;
use PIACS\Database;
use \Exception;
use \stdClass;
use PIACS\ProductCallbacks;
use \WC_Product_Simple;
use \WC_Product_Variation;

defined( 'ABSPATH' ) || exit;

class Product{

	// Campo do SKU no Webservice
	public static $skuField = 'Code';

	/*
		Campo do WebService => 
			array(
				Metodo do Woocomerce para o campo,
				Callback de processamento do dado
			)
	*/
	public static $callbacks = array(
		'Id' 				=> array(array('ACF', 'PIACS_Id'), null),
		'StockId' 			=> array(array('ACF', 'PIACS_StockId'), null),
		'Code' 				=> array('sku', null),
		'Name' 				=> array('name', null),
		'BarCode' 			=> array(array('ACF', 'PIACS_codebar'), null),
		'Category' 			=> array('category_ids', 'getCategoryIds'),
		'Brand' 			=> array('description', 'fabricante'),
		'PeriodicBarcode' 	=> array(null, null),
		'IsSubscription' 	=> array(null, null),
		'HasInventory' 		=> array(null, null),
		'MeasureUnitCode' 	=> array(null, null),
		'MeasureUnitName' 	=> array(null, null),
		'AccountingGroup' 	=> array(null, null),
		'Storehouse' 		=> array('manage_stock', 'true'),
		'Quantity' 			=> array('stock_quantity', null),
		'Price' 			=> array('regular_price', null),
		'DiscountMax' 		=> array(null, null)
	);

	public static $commonMethods = array(
		'is_in_stock' => true,
	);

	private $ignoreUpdate = array();


	private $product = null;
	private $errors = array();

	public function __construct($dados){
		$this->product = new stdClass();

		foreach ($dados as $key => $value)
			$this->setAttribute($key, $value);

		$id = wc_get_product_id_by_sku($this->product->{self::$skuField});
		$this->setAttribute('id', (($id == 0) ? null : $id) );

		if($this->product->id !== null && $list = Settings::get('campos_ignore_get'))
			$this->ignoreUpdate = json_decode($list);
	}

	private function setError($message){
		$this->errors[] = $message;
	}

	public function hasErrors(){
		if(count($this->errors))
			return true;

		return false;
	}

	public function getErrors(){
		if(!$this->hasErrors())
			return null;

		$msg = '';
		foreach ($this->errors as $error) 
			$msg .= $error ."\r\n";
		
		return $msg;
	}

	private function setAttribute($attr, $value){
		if(!isset(self::$callbacks[$attr])){
			$this->product->{$attr} = $value;
			return;
		}

		$callback = self::$callbacks[$attr];

		try {
			if(!is_null($callback[1]))
				$value = ProductCallbacks::{$callback[1]}($value);
			
			$this->product->{$attr} = $value;
		
		} catch (Exception $e) {
			die($e->getMessage());
			$this->setError($e->getMessage());
		}
	}

	public function save(){
		try {
			// if(empty($this->product->Category))
			// 	return false;

			if($this->hasErrors())
				throw new Exception("Eu não posso processar esse produto, há erros de validação nele!", true);

			
			if ($this->product->id != null && get_post_type($this->product->id) == 'product_variation')
		    	$product = new WC_Product_Variation($this->product->id);
		    else
				$product = new WC_Product_Simple($this->product->id);


			foreach ($this->product as $key => $value){
				if(in_array($key, $this->ignoreUpdate))
					continue;

				if(self::$callbacks[$key][0] !== null){
					$callback = self::$callbacks[$key][0];

					if(is_array($callback))
						${$callback[0]}[$callback[1]] = $value;

					else
						$product->{'set_'. $callback}($value);
				}

			}

			foreach (self::$commonMethods as $key => $value){
				if(in_array($key, $this->ignoreUpdate))
					continue;

				$product->{$key}($value);
			}

			$id = $product->save();
			
			if(isset($ACF) && is_array($ACF)){
				foreach ($ACF as $key => $value) 
					update_post_meta($id, $key, $value);
			}
				
			
			return true;
		} catch (Exception $e) {
			$this->setAttribute('log', $e->getMessage());
			$this->reportError();
			return false;
		}
	}


	private function reportError(){
		$this->product->log .= "Informações do erro:\r\n" . $this->getErrors();
//		Database::insert('products', $this->product);
	}




}