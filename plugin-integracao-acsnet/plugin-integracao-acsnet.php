<?php
/**
 * Plugin Name:       Plugin de Integração com ACSNET
 * Plugin URI:        
 * Description:       Plugin de Integração com o sistema de gestão ACSNET
 * Version:           2.2
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            William Steffen Alievi
 * Author URI:        https://alievi.com.br
 * License:           
 * License URI:       
 *
 * @package         Landing_Page_Tools
 */

defined( 'ABSPATH' ) || exit;

define('PLUGIN_FILE', __FILE__);
define('PLUGIN_NAME', 'piacs');
define('PLUGIN_PATH', untrailingslashit( plugin_dir_path( PLUGIN_FILE) ));
define('PLUGIN_URL', untrailingslashit( plugins_url( '/', PLUGIN_FILE) ));


require_once PLUGIN_PATH . '/includes/Plugin.php';

if (class_exists('Plugin')){


	function PIACS() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
		return Plugin::getInstance();
	}

	add_action('plugins_loaded',array(PIACS(),'init'));

	// activation
	register_activation_hook(PLUGIN_FILE, array(PIACS(), 'activate'));

	// deactivation
	register_deactivation_hook(PLUGIN_FILE, array(PIACS(), 'deactivate'));

    // Uninstall
    // register_uninstall_hook(PLUGIN_FILE, array(PIACS(), 'uninstall'));

    // Configurações e menus
    add_action('admin_menu', array(PIACS(), 'settings_menu'));
    
    // Ação AJAX do botão de executar consulta ao WebService
    add_action( 'wp_ajax_piacs_getDados', array(PIACS(), 'processaDados'));

    // Ação AJAX de processar uma ordem no webservice
    add_action('wp_ajax_piacs_orders', array(PIACS(), 'processaOrdens'));

    // Ação AJAX de buscar as categorias do WebService
    add_action('wp_ajax_piacs_getCats', array(PIACS(), 'processaCategorias'));

    // Ação AJAX de trocar ativar/desativar categoria
    add_action('wp_ajax_piacs_changeStatus', array(PIACS(), 'mudaStatus'));

    add_action('wp_ajax_piacs_saveSettings', array(PIACS(), 'saveSettings'));
}
