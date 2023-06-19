<?php

namespace PIACS;
use \Exception;
use PIACS\Categories;
use PIACS\Settings;
use WooCommerce\WC_Order;

defined( 'ABSPATH' ) || exit;

class OrderCallbacks{

	// Esse Metodo não pode ser chamado no Order
	public static function getMeta($key, $id){
		try {
			return wc_get_order($id)->get_meta($key);

		} catch (Exception $e) {
			return null;
		}
	}

	// Esse Metodo não pode ser chamado no Order
	public static function getAcf($key, $id){
		return get_field('PIACS_'. $key, (int) $id);
	}

	public static function getIdProduto($id = null){
		return self::getAcf('Id', $id);
	}

	public static function getStockId($id = null){
		return self::getAcf('StockId', $id);
	}

	public static function getCpf($id = null){
		$cpf = self::getMeta('_billing_cpf', $id);
		
		return preg_replace("/[^0-9]/", "", $cpf);

	}

	public static function getNome($array = null){
		return $array['first_name'] .' '. $array['last_name'];
	}

	public static function getCep($array = null){
		return preg_replace("/[^0-9]/", "", $array['postcode']);
	}

	public static function getEndereco($array = null){
		return $array['address_1'];
	}
	public static function getEndNumero($id = null){
		return self::getMeta('_shipping_number', $id);
	}

	public static function getEndComplemento($array = null){
		return $array['address_2'];
	}		

	public static function getEndBairro($id = null){
		return self::getMeta('_billing_neighborhood', $id);
	}

	public static function getTotal($id = null){

	}

	public static function toString($value = null){
		return (string) $value;
	}

	// Se foi cobrado frete tem que retornar o CNPJ da transportadora
	public static function getCnpjTransport($value = null){
		if(is_null($value) || $value == '0')
			return null;

		// Retornar sem mascara sempre
		return Settings::get('cnpj_transp');
	}

	// Metodo de envio 9 sem frete, 5 frete por conta da loja
	public static function getTransport($value = null){
		if(is_null($value) || $value == '0' || $value == "0.00")
			return 9;

		return 5;
	}

	// Processa valor do frete
	public static function getValorDoFrete($value = null){
		if($value !== null && $value != '0')
			//return self::setNumeric($value);
			return $value;

		//para ser ignorado no submit
		return ;
	}

	// As vezes precisa converter para numerico a string
	public static function setNumeric($value = null){
		return (float) $value;
	}

	// O tipo será sempre 0 (Pedido de Saída), não usar 1 (Pedido de Material Escolar)
	public static function getOrderType($value = null){
		return 0;
	}

	// Será retornado sempre 0 que representa Dinheiro
	public static function getPaymentMethod($value = null){
		//return 0; 
		return 5;
		/*
		Tipo de forma de Pagamento: 0 - Pagamento em
		Dinheiro
		1 - Pagamento em Cartão
		de Débito
		     18/10/2021 API ECommerce1.5
		Página 4 de 11
		  Projeto
		ACSNet
		Responsável
		Wesley Mazzo
		2 - Pagamento em Cartão de Crédito
		3 - Pagamento em Cheque
		6 – Pagamento em Vale Refeição
		7 - Pagamento em Vale Alimentação
		17 - Pagamento Instantâneo(PIX)
		*/
	}

	// Tipo de compra, loja virtual será sempre 1 (não presencial, pela internet)
	public static function getPresenca($value = null){
		return 1;
	}


	public static function calcPercent($desc, $total){
		$desc = (( $desc / ( $total / 100 )) / 100);

		if($desc > 1 || $desc < 0)
			throw new Exception("Erro no percentual de desconto". $desc." - ".$total, True);
			
		return $desc;
	}

	public static function calcDescProd($valor, $perc){
		return number_format(($valor * $perc), 2);
	}

	public static function GetArrayProducts($id = null){

		$order = wc_get_order($id);

		$products = $order->get_items();

		if($products === null)
			throw new Exception("Não há produtos no pedido que você esta submentendo ao WebService", true);

		$sum_tot_prod = 0;
		$count = 0;

		foreach ($products as $product) {
			if ($product->get_total()>0){
				$sum_tot_prod += $product->get_total();
				$count++;
		    }			
		}

		$order_data = $order->get_data();
		$order_shipping_total = $order_data['shipping_total'];


		$discount_total = $sum_tot_prod - ($order->get_total()-$order_shipping_total);


		$discount_total_countsdonw = $discount_total;

		if ($discount_total>0){
			$percent = self::calcPercent($discount_total, $sum_tot_prod);
		} else {
			$percent = 0;
		}

 	 	$produtos = array();


 		$count2 = 0;
		foreach ($products as $product) {
			if ($product->get_total()>0){
				$count2++;
				$tmp = array();

			 	//a default
			    $idProd = $product->get_product_id();

			    $produtosl = $product->get_product();

			    $type = $produtosl->get_type();

			    //check if this is a variation using is_type
			    if( $type === 'variation') {
			        $idProd = $product->get_variation_id();
			    }
			   

				$tmp['Id'] 				= self::getIdProduto($idProd);
				$tmp['Quantity'] 		= $product->get_quantity();
				$tmp['StockId'] 		= self::getStockId($idProd);
	/*
	if($product->get_sale_price() != $product->get_regular_price()){
		wc_add_order_item_meta($idProd,'_discounted_item', $product->get_regular_price());
	}
	*/

				$tmp['TotalProduct'] 	= $product->get_total();

				
				if($discount_total>0){
					$tmp['DiscountItem'] 	= self::calcDescProd($product->get_total(), $percent);
					
					$sobra_desconto = $discount_total_countsdonw;
					$discount_total_countsdonw -= $tmp['DiscountItem'];
					
					if ($count2 == $count)			
						$tmp['DiscountItem'] = number_format($sobra_desconto, 2);
				} 

				/*
				if($discount_total>0){
					$tmp['DiscountItem'] 	= self::calcDescProd($product->get_total(), $percent);
					
					$valordescontoantigo = $discount_total_countsdonw;
					$discount_total_countsdonw -= $tmp['DiscountItem'];

					if ($discount_total_countsdonw<0){
						$tmp['DiscountItem'] = number_format($valordescontoantigo, 2);
					}
					
					if ($count2 == $count){	
						throw new Exception("Falta de desconto:".$discount_total_countsdonw, true);							

						$tmp['DiscountItem'] = $discount_total_countsdonw;
				
					}
				} 
				*/
				//$tmp['DiscountItem'] 	= $discount_total;
				$produtos[] = $tmp;
			}
		}
		
		return $produtos;
	}

	public static function getInvoiceRemarks($orderId = null){
		if($orderId === null)
			throw new Exception("Um erro", true);
		
		$order = wc_get_order($orderId);
		$order_data = $order->get_data();
		
		$order_comments = $order_data['order_comments'];
		$order_escola = $order_data['additional_escola'];
		$order_aluno = $order_data['additional_aluno'];
		$order_serie = $order_data['additional_serie'];
		$order_responsavel = $order_data['additional_responsavel'];

		// $invoice = array(
		// 	array(
		// 		'order_comments' => $order_data['order_comments'],
		// 		'order_escola' => $order_data['additional_escola'],
		// 		'order_aluno' => $order_data['additional_aluno'],
		// 		'order_serie' => $order_data['additional_serie'],
		// 		'order_responsavel' => $order_data['additional_responsavel']
		// 	)
		// );
		$invoice = "{$order_comments}\n{$order_escola}\n{$order_aluno}\n{$order_serie}\n{$order_responsavel}";
		return $invoice;
		
	}

	public static function GetArrayPayments($orderId = null){
		if($orderId === null)
			throw new Exception("Um erro", true);

		$order = wc_get_order($orderId);
		$order_data = $order->get_data();
		$order_payment_method = $order_data['payment_method'];
		$order_shipping_total = $order_data['shipping_total'];

		$total = $order->get_total();

		$payment = array(
			array(
				'ValuePay' 		=> number_format($total, 2, '.', ''), 
				'PaymentType' 	=> self::getPaymentMethod(5),
				'DocNumberOfCardOperator' => Settings::getCnpjOperador($order->get_payment_method())

			)
		);

		return $payment;
	}





}