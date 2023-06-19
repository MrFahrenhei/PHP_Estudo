<?php

namespace PIACS;
use \Exception;
use PIACS\Categories;

defined( 'ABSPATH' ) || exit;

class ProductCallbacks{

	public static function getCategoryIds($name){
		$id = Categories::getCategoryId($name, false);
		if($id === null)
			return array();

		if(in_array($id, Database::getActiveCategories()))
			return array($id);

		return null;
	}


	public static function valor($valor){
		return (string) $valor;
	}

	public static function true($value = null){
		return True;
	}

	public static function fabricante($value = null){
		if(is_null($value))
			return "";

		return $value;
	}


}