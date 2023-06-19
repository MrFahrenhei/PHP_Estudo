<?php

namespace PIACS;
use \stdClass;
use PIACS\Database;
use PIACS\Product;

defined( 'ABSPATH' ) || exit;

class Settings
{
    private static $view = PLUGIN_PATH  . '/view/';
    private static $slug = PLUGIN_PATH  . '/view/menu.php';

    private static $fields = array(
        'token_url'         => true,
        'client_id'         => true,
        'client_secret'     => true,
        'scope'             => true,
        'order_url'         => true,
        'get_url'           => true,
        'establishment'     => true,
        'cat_sub_order'     => false,
        'cat_dest_order'    => false,
        'cat_fim_order'     => false,
        'cnpj_payment'      => false,
        'cnpj_transp'       => false,
        'campos_ignore_get' => false,
        'live_to_log'       => 30,
        'nfe_url'           => true,
        'live_cache_nfe'    => 15,
        'max_cache_nfe'     => 200,
        'payment_send_cnpj' => false,
    );

    public static function top_menu() {  
        add_menu_page(
            'Integração ACSNET',
            'Integração ACSNET',
            'read',
            self::$slug,
            '',
            'dashicons-rest-api',
            1
        );
    } 

    public static function sub_menu($title, $fileView, $pos = 99){
        add_submenu_page(self::$slug, 'Informações das Consultas ao ACSNET', $title, 'read', self::$view . $fileView .'.php', '', $pos );
    }

    public static function get($key){
        $conf = Database::getConfig($key);

        if($conf !== false)
            return $conf;

        if(!is_bool(self::$fields[$key]))
            return self::$fields[$key];

        return false;
    }



    public static function getListFieldsWS(){
        $list = array();
        foreach (Product::$callbacks as $key => $value) {
            $obj = new stdClass();
            $obj->text      = $key;
            $obj->checked   = ($value[0] == null) ? 'checked' : '';
            $obj->disabled  = ($value[0] == null || Product::$skuField == $key) ? 'disabled' : '';
            $obj->obs       = (Product::$skuField != $key) ? null : "Este Campo não pode ser ignorado";
            $list[] = $obj;
        }

        return $list;
    }



    public static function validSettings(){
        foreach (self::$fields as $key => $value) {
            if($value === false)
                continue;
            
            if(self::get($key) === false)
                return false;
        }

        return true;
    }

    public static function save($dados){ 

        if(!Database::clearConfigMemory())
            throw new Exception("Erro ao limpar a tabela de memória", true);
            

        foreach ($dados as $key => $value) {
            if($key === 'action')
                continue;

            if(is_array($value))
                $value = json_encode($value);

            Database::insert('configs', array('key' => $key, 'value' => $value));
        }
    }


    public static function getCnpjOperador($method){
        if(!in_array($method, json_decode(self::get('payment_send_cnpj'))))
            return null;

        return self::get('cnpj_payment');

    }







}