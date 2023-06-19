<?php

namespace PIACS;
use \Exception;
use PIACS\OrderCallbacks;
use PIACS\Integration;
use PIACS\Settings;
use PIACS\Database;

defined( 'ABSPATH' ) || exit;

class Order{

	/*
		Campo do webservice => 
			array(
				campo no WooCommerce,
					- Se NULL o Callback deve retornar o valor
					- Se FALSE o campo será ignorado

				Callback de processamento do dado (Class OrderCallbacks)
			)
	*/
	public static $callbacks = array(
		'OrderNumber' 						=> array('id', 'toString'), //ID_ORDER do Wordpress
		'OrderType'							=> array(null, 'getOrderType'),
		'Customer.DocNumber' 				=> array('id', 'getCpf'),
		'Customer.Name'						=> array('shipping', 'getNome'),

		'Customer.Address.PostalCode'	 	=> array('shipping', 'getCep'),
		'Customer.Address.Address'			=> array('shipping', 'getEndereco'),
		'Customer.Address.Number'			=> array('id', 'GetEndNumero'),
		'Customer.Address.Complement'		=> array('shipping', 'getEndComplemento'),
		'Customer.Address.District'			=> array('id', 'getEndBairro'),


/**
	Produtos são modelados no callback GetArrayProducts

		'OrderProducts.Id'					=> array(null, null), //array de produtos
		'OrderProducts.Quantity'	 		=> array(null, null), //array de produtos
		'OrderProducts.StockId'				=> array(null, null), //array de produtos
		'OrderProducts.TotalProduct'		=> array(null, null), //array de produtos
		'OrderProducts.DiscountItem'		=> array(null, 'zero'), //array de produtos
*/
		'OrderProducts'						=> array('id', 'GetArrayProducts'), //Monta array de produtos

/*
	Metodo de pagamento é modelado no callback GetArrayPayments

		'OrderPayments.PaymentType'			=> array(null, 'getPaymentMethod'), //Tipo dinheiro (Validar)
		'OrderPayments.ValuePay'			=> array('total', null), //Total do pedido
*/
		'OrderPayments'						=> array('id', 'GetArrayPayments'), //Total do pedido


		'BuyerPresence'						=> array(null, 'getPresenca'), //Tipo de Comprador
		'IntermediaryDocNumber'				=> array(false, null), //CNPJ Da Loja?

		'Shipping.ShippingType'				=> array('shipping_total', 'getTransport'),
		'Shipping.ShippingCompanyDocNumber'	=> array('shipping_total', 'getCnpjTransport'),
		'Shipping.ShippingValue'			=> array('shipping_total', 'getValorDoFrete'),

		'SchoolInfo.SchoolDocNumber' 		=> array(false, null),
		'InvoiceRemarks' 					=> array('id', 'getInvoiceRemarks'),
	);

	private $orderId = null;

	private $order = array();

	function __construct($order){

		try {
			$this->orderId = (int) $order['id'];

			foreach (self::$callbacks as $key => $value) {
				$field 	= $value[0];
				$method = (isset($value[1]) ? $value[1] : null);

				if($field === false)
					continue;

				if($field === null)
					$val = null;

				else
					$val = $order[$field];

				if($method !== null && method_exists('PIACS\OrderCallbacks', $method))
					$val = OrderCallbacks::{$method}($val);

				elseif($method !== null)
					throw new Exception("O metodo de callback \"". $method ."\" é inválido!", true);
					
				
				if(is_object($val))
					$val = null;


				$this->order = array_merge_recursive($this->order, self::serialize($key, $val));
			}

		} catch (Exception $e) {
			$this->logOrder($e->getMessage());
			throw new Exception($e->getMessage(), true);
			
		}
	}


	private static function serialize($key, $value){	
		if(strpos($key, '.')){
			$key = explode('.', $key, 2);
			$value = self::serialize($key[1], $value);
			$key = $key[0];
		}

		return array($key => $value);
	}


	public function exec(){

		try {
			$con = new Integration();
			$response = $con->submitOrder($this->order);
			if($response->Success !== True)
				throw new Exception(implode(", ", $response->Errors), True);
			
				
			$this->saveReturn($response->Data->OrderId, $response->Data->OrderType);
			$this->logOrder("Pedido salvo no ACSnet com ID ".$response->Data->OrderId);

			$this->ConfirmOrder();

		} catch (Exception $e) {
			$this->logOrder($e->getMessage());
		}

	}

	private function saveReturn($AcsOrderId, $OrderType){
		$log = array(
			'order_id' => $this->orderId,
			'acs_order_id' => $AcsOrderId,
			'OrderType' => $OrderType,
		);

		Database::insert('orders_id', $log);
	}


	private function logOrder($message = null){
		if($message === null)
			return false;

		$order = wc_get_order($this->orderId);
		$order->add_order_note($message);
	}

	private function ConfirmOrder(){
		$order = wc_get_order($this->orderId);
		$order->update_status(Settings::get('cat_dest_order'));
	}
}












