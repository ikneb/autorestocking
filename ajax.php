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
require_once(dirname(__FILE__) . '/classes/EmailTemplate.php');
require_once(dirname(__FILE__) . '/classes/Providers.php');
require_once(dirname(__FILE__) . '/classes/Relation.php');
require_once(_PS_MODULE_DIR_ . 'autorestocking/autorestocking.php');


switch (Tools::getValue('ajax')) {

    case 'save_update_template_email':
        echo EmailTemplate::updateTemplate(Tools::getValue('tiny'));
        break;
    case 'update_relation':
        echo Relation::updateRelation();
        break;
    case 'save_update_provider':
        if (Tools::getValue('id_provider') == null) {
            echo Providers::insertProviderReturnId();
        } else {
            echo Providers::updateProvider();
        }
        break;
    case 'render_relation':
        echo Relation::getAllProductByProviderId();
        break;
    case 'add_product_for_relation':
        echo Relation::saveRelationProductByProvider();
        break;
    case 'add_product_tree':
        echo Tools::jsonEncode(Relation::getProductsAllCategories());
        break;
    case 'add_product_autocomplete':
        echo Tools::jsonEncode(Relation::getCategoryIdByProduct());
        break;
    case 'delete_relation':
        echo Relation::deleteRelationByIdRelation();
        break;
    case 'get_product_attr':
        echo Tools::jsonEncode(Relation::getAttributeByIdProduct(Tools::getValue('id_product')));
        break;
    case 'save_configuration':
        echo AutoRestocking::updateConfig();
        break;
    case 'update_relation_for_product_tab':
        echo Relation::saveRelationCombination();
        break;
}
