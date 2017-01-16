<?php
require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/Relation.php');
require_once(dirname(__FILE__).'/classes/Providers.php');



if(Tools::getValue('ajax_tab')){
    $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
//    echo Tools::jsonEncode(Relation::getAllCategoryByProviderId(Tools::getValue('id_provider')));
print_r(Relation::setProductByCategoryId(3,$id_lang,1));

}

