<?php

namespace PIACS;
use PIACS\Integration;
use PIACS\Database;

defined( 'ABSPATH' ) || exit;

class Categories{
	public static function getCategoryId($name, $create = false){
		$cat = get_term_by( 'slug', str_replace(" ", "-", $name), 'product_cat');

		if(is_object($cat))
			return $cat->term_id;

		if($create)
			return self::setCategory($name);

		return null;
	}

	public static function setCategory($name){
		return wp_insert_term( $name, 'product_cat', array(
			'slug' => str_replace(" ", "-", $name) // optional
		))['term_id'];
	}

	public static function getCategories(){
		$cats = get_terms( 'product_cat', array('hide_empty' => false));
		
		$actives = Database::getActiveCategories();	

		foreach ($cats as $cat)
			$cat->active = in_array(self::getCategoryId($cat->name), $actives);
		
		return $cats;
	}

	public static function changeStatus($id){
		if(in_array($id, Database::getActiveCategories()))
			Database::deactiveCategory($id);
		else
			Database::activeCategory($id);
	}


	public function syncCategories(){
		$integ = new Integration();
		$prods = $integ->requestProducts();

		$cats = array();

		foreach ($prods as $prod) {
			if(!isset($cats[$prod->Category]))
				$cats[$prod->Category] = self::getCategoryId($prod->Category, true);
		}
	}
}