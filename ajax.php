<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/EmailTemplate.php');
require_once(dirname(__FILE__).'/classes/Providers.php');
require_once(dirname(__FILE__).'/classes/Relation.php');


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
    if (Tools::getValue('id_provider') == null) {
      echo Providers::insertProviderReturnId();
    } else {
      echo Providers::updateProvider();
    }
    break;
  case 5:
    echo Relation::getAllProductByProviderId($smarty);
    break;
  case 6:
   print_r(Relation::saveRelationProductByProvider());
    break;
  case 7:
   echo Tools::jsonEncode(Relation::getProductsAllCategories());
    break;
  case 8:
    echo Relation::getCategoryIdByProduct();
    break;
  case 9:
    echo Relation::deleteRelationByIdRelation();
    break;
  case 10:
    echo Tools::jsonEncode(Relation::getAttributeByIdProduct(Tools::getValue('id_product')));
    break;
  case 11:
    /*$product = new Product(Tools::getValue('id_products'));
    echo $product->hasAttributes();*/
    break;
  case 12:
    echo Relation::saveRelationCombination();
    break;
}

