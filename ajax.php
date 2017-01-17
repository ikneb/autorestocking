<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/EmailTemplate.php');
require_once(dirname(__FILE__).'/classes/Providers.php');
require_once(dirname(__FILE__).'/classes/Relation.php');


if(Tools::getValue('tiny')){
  echo EmailTemplate::updateTemplate(Tools::getValue('tiny'));
}elseif(Tools::getValue('submitAddproviders')){
  if(Tools::getValue('id_providers') == null){
    echo Providers::insertProviderReturnId();
  }else{
    echo Providers::updateProvider();
  }
}elseif(Tools::getValue('submitProductRelation')){
  echo Relation::saveRelationProductByProvider();
}elseif(Tools::getValue('submitAddrelation')){
  echo Relation::updateRelation();
}elseif(Tools::getValue('submitRelation')){
  echo Relation::saveRelationCategoryByProvider();
}





