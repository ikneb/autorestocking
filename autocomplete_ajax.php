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


$id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

$sql = 'SELECT `id_product`, `name`
		FROM `' . _DB_PREFIX_ . 'product_lang` WHERE id_lang = ' . $id_lang;
$items = Db::getInstance()->executeS($sql);

$result = '';
foreach ($items as $item) {
    $result .=  trim($item['name']) . '|' . (int)($item['id_product']) . "\n";
}

echo $result;
