<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');


$arr = array(array('name'=> 'test', 'reference' => 'test', 'id_product' => 0),
    array('name'=> 'ura', 'reference' => 'test1', 'id_product' => 1),
    array('name'=> 'test2', 'reference' => 'test2', 'id_product' => 2));


$id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

$sql = 'SELECT `id_product`, `name`
		FROM `'._DB_PREFIX_.'product_lang` WHERE id_lang = '. $id_lang;

$items = Db::getInstance()->executeS($sql);


foreach ($items as $item) {
    echo trim($item['name']).'|'.(int)($item['id_product'])."\n";
}

