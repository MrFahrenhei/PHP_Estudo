<?php

use PIACS\Activate;
use PIACS\Deactivate;
use PIACS\Uninstall;
use PIACS\Settings;
use PIACS\Integration;
use PIACS\Orders;
use PIACS\Order;
use PIACS\Categories;


defined( 'ABSPATH' ) || exit;


final class Plugin
{

	private $version = "1.0.0";
	public static $plugin_name = 'piacs';


	private static $_instance = null;

	/**
	 * The Singleton's constructor should always be private to prevent direct
	 * construction calls with the `new` operator.
	 */
	protected function __construct()
	{
		$this->autoloader();
	}

	/**
	 * Singletons should not be cloneable.
	 */
	protected function __clone() { }

	/**
	 * Singletons should not be restorable from strings.
	 */
	protected function __wakeup() { }

	public static function getInstance() : ?Plugin
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function init(){

	}

	public function processaDados(){
		$Integration = new Integration();
		wp_send_json($Integration->exec());
	}

	public function processaOrdens(){
		if(isset($_POST['orderId'])){
			foreach ($_POST['orderId'] as $orderId){
				try {
					$obj = new Order(wc_get_order($orderId)->get_data());
					$obj->exec();
				} catch (Exception $e) {
					throw new Exception($e->getMessage(), true);
				}
			}

		}else{
			$ordem = new Orders($id);
		}

	}

	public function processaCategorias(){
		$tmp = new Categories();
		$tmp->syncCategories();
	}


	public function settings_menu(){
		Settings::top_menu();
		if(Settings::validSettings()){
			Settings::sub_menu('Consulta Produtos', 'get_dados', 10);
			Settings::sub_menu('Consulta Categorias', 'get_cats', 20);
			Settings::sub_menu('Ordens para Processar', 'ordens', 30);
			Settings::sub_menu('Lista de Pedidos e NFe', 'nfe', 40);
		}
		Settings::sub_menu('Logs de Integração', 'logs', 98);
		Settings::sub_menu('Configurações', 'admin');
	}

	public function saveSettings(){
		Settings::save($_POST);
	}

	public function activate(){
		Activate::activate();
	}

	public function deactivate(){
		Deactivate::deactivate();
	}

	public function uninstall(){
		Uninstall::uninstall();
	}

	public function getCategories(){
		return Categories::getCategories();
	}

	public function mudaStatus(){
		Categories::changeStatus($_POST['id']);
	}

	private function autoloader() {
		require_once PLUGIN_PATH . '/includes/Autoloader.php';

		Autoloader::exec();
	}
}
