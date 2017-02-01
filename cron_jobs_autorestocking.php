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
require_once(dirname(__FILE__) . '/classes/Relation.php');
require_once(dirname(__FILE__) . '/classes/Providers.php');
require_once(dirname(__FILE__) . '/classes/EmailTemplate.php');
require_once(dirname(__FILE__) . '/classes/Email.php');
require_once(_PS_MODULE_DIR_ . 'autorestocking/autorestocking.php');


$time = Configuration::get('PS_AUTOCRON_TIME');
$current_time = time();
$dif = $current_time - $time;
if ($dif > 10 && Configuration::get('PS_CRON_AUTORESTOCKING_METHOD') == 1) {
    $time = Configuration::updateValue('PS_AUTOCRON_TIME', time());
    AutoRestocking::autoCron();
}
