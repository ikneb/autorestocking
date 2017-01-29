<?php

require_once(dirname(__FILE__) . '../../../config/config.inc.php');
require_once(dirname(__FILE__) . '../../../init.php');
require_once(_PS_MODULE_DIR_ . 'autorestocking/autorestocking.php');


if (Tools::getValue('status')) {
    echo Autorestocking::changeStatus();
}