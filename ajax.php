<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/EmailTemplate.php');
require_once(dirname(__FILE__).'/classes/Providers.php');
require_once(dirname(__FILE__).'/classes/Relation.php');


if(Tools::getValue('submitAddproviders')) {
  if (Tools::getValue('id_providers') == null) {
    echo Providers::insertProviderReturnId();
  } else {
    echo Providers::updateProvider();
  }
}
/*}elseif(Tools::getValue('submitProductRelation')){ add one product
  echo Relation::saveRelationProductByProvider();*/
/*elseif(Tools::getValue('submitRelation')){
  echo Relation::saveRelationCategoryByProvider();
}*/

switch (Tools::getValue('ajax')) {
  case 1:
    print_r(Relation::getProductsAllChildrenCategories(Tools::getValue('id_category')));
    break;
  case 2:
    echo EmailTemplate::updateTemplate(Tools::getValue('tiny'));
    break;
  case 3:
    echo Relation::updateRelation();
    break;
  case 4:
    if (Tools::getValue('id_providers') == null) {
      echo Providers::insertProviderReturnId();
    } else {
      echo Providers::updateProvider();
    }
    break;
  case 5:
    echo Relation::getAllProductByProviderId($smarty);
    break;
  case 6:
//    echo Relation::saveRelationProductByProvider();
    print(Tools::getValue('products'));
    break;
  case 7:
   echo Tools::jsonEncode(Relation::getProductsAllCategories());
//    print_r(Relation::getProductsAllCategories());
    break;
}

