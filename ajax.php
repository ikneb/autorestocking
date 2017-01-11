<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/EmailTemplate.php');


if(isset($_POST['tiny'])){
  echo EmailTemplate::updateTemplate($_POST['tiny']);
}




