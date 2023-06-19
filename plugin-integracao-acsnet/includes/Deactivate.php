<?php

namespace PIACS;
use PIACS\Database;

defined( 'ABSPATH' ) || exit;

class Deactivate{
	protected function __construct(){
	}

	public static function deactivate(){
		Database::dropTable('tokens');
		Database::dropTable('logs');
		Database::dropTable('configs_memory');
		Database::dropTable('nfe');

		// Tabela não utilizada pelo sistema
		Database::dropTable('products');

		flush_rewrite_rules();
	}
}
