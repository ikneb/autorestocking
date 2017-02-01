<?php
/**
 * 2016 WeeTeam
 *
 * @author    WeeTeam
 * @copyright 2016 WeeTeam
 * @license   http://www.gnu.org/philosophy/categories.html (Shareware)
 */

require_once(dirname(__FILE__) . '../../../config/config.inc.php');
require_once(dirname(__FILE__) . '../../../init.php');
require_once(_PS_MODULE_DIR_ . 'autorestocking/autorestocking.php');
require_once(dirname(__FILE__) . '/classes/Relation.php');


if (Tools::getValue('status')) {
    echo Autorestocking::changeStatus();
}
