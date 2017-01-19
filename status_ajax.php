<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/Relation.php');


if(Tools::getValue('status')){
   echo Relation::changeStatus();
}