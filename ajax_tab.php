<?php
require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/Relation.php');
require_once(dirname(__FILE__).'/classes/Providers.php');



if(Tools::getValue('ajax_tab')){
 echo Relation::getAllProductByProviderId($smarty);
}

