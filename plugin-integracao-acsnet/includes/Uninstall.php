<?php

namespace PIACS;
use PIACS\Database;
use PIACS\Deactivate;

defined( 'ABSPATH' ) || exit;

class Activate{
	
	protected function __construct(){
	}

	public static function uninstall(){
		Deactivate::dropTables();
		
		Database::dropTable('configs');
		Database::dropTable('active_categories');


		flush_rewrite_rules();
	}
}