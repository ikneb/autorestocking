<?php
if (!defined('_PS_VERSION_'))
    exit;
include_once(_PS_MODULE_DIR_.'autorestocking/classes/Providers.php');
include_once(_PS_MODULE_DIR_.'autorestocking/classes/Relation.php');
include_once(_PS_MODULE_DIR_.'autorestocking/classes/Email.php');
include_once(_PS_MODULE_DIR_.'autorestocking/classes/EmailTemplate.php');

class AutoRestocking extends Module
{
    public function __construct()
    {
        $this->name = 'autorestocking';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'Weeteam';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Auto Restocking');
        $this->description = $this->l('Products auto restocking');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        $this->init();
    }

    public function init()
    {
        $this->postProcess();
    }

    public function install()
    {
        $mail_config = array(
            'shop_name' => Configuration::get('PS_SHOP_NAME'),
            'mail_text' => 'Hello'
        );

        if (!parent::install()
            || !$this->registerHook('displayBackOfficeHeader')
            || !$this->registerHook('displayAdminProductsExtra'))
            return false;

        $this->installDb();

            $parent_tab = new Tab();
            // Need a foreach for the language
            $parent_tab->name[$this->context->language->id] = $this->l('Autorestocking');
            $parent_tab->class_name = 'AdminProviders';
            $parent_tab->id_parent = 0; // Home tab
            $parent_tab->module = $this->name;
            $parent_tab->add();

            $tab = new Tab();
            $tab->name[$this->context->language->id] = $this->l('Providers');
            $tab->class_name = 'AdminProviders';
            $tab->id_parent = $parent_tab->id;
            $tab->module = $this->name;
            $tab->add();

            $tab = new Tab();
            $tab->name[$this->context->language->id] = $this->l('Sent email');
            $tab->class_name = 'AdminEmail';
            $tab->id_parent = $parent_tab->id;
            $tab->module = $this->name;
            $tab->add();

            $tab = new Tab();
            $tab->name[$this->context->language->id] = $this->l('Template email');
            $tab->class_name = 'AdminEmailTemplate';
            $tab->id_parent = $parent_tab->id;
            $tab->module = $this->name;
            $tab->add();

        return true;
    }

    public function installDb()
    {
        $sql = array();
        include(dirname(__FILE__) . '/sql/install.php');
        foreach ($sql as $s)
            if (!Db::getInstance()->execute($s))
                return false;
        return true;
    }

    public function uninstall()
    {
        $sql = array();
        include(dirname(__FILE__) . '/sql/uninstall.php');
        foreach ($sql as $s)
            if (!Db::getInstance()->execute($s))
                return false;

        if (!parent::uninstall())
            return false;

        Tab::disablingForModule($this->name);

        return true;
    }

    public function hookDisplayBackOfficeHeader() {
        $this->context->controller->addCss($this->_path.'views/css/autorestocking.css');
        $this->context->controller->addJquery();
        $this->context->controller->addJS($this->_path.'views/js/product_tab.js');
    }

    public function hookDisplayAdminProductsExtra($params) {

        if(version_compare(_PS_VERSION_,'1.7','<')){
            $id_product = Tools::getValue('id_product');
        }else{
            $id_product = Tools::getValue('id_product',$params['id_product']);
        }

        $product  = new Product($id_product);
        $has_combination = $product->hasAttributes();
        $providers = Providers::getAll();

        $autorestocking = $has_combination ? Relation::getAllByProductId($id_product) : Relation::getRowByProductId($id_product);

        $combination = $autorestocking ? Relation::getCombinationAndReelation($id_product) : Relation::getAttributeByIdProduct($id_product);
        $this->smarty->assign(array(
            'providers' => $providers,
            'relations' => $autorestocking,
            'has_combination' => $has_combination,
            'has_comb_tpl' => _PS_MODULE_DIR_.'autorestocking/views/templates/admin/has_comb.tpl',
            'not_comb_tpl' => _PS_MODULE_DIR_.'autorestocking/views/templates/admin/not_comb.tpl',
            'has_comb_tpl_new' => _PS_MODULE_DIR_.'autorestocking/views/templates/admin/has_comb_new.tpl',
            'not_comb_tpl_new' => _PS_MODULE_DIR_.'autorestocking/views/templates/admin/not_comb_new.tpl',
            'combinations' => $combination,
            'version' => version_compare(_PS_VERSION_,'1.7','<')
        ));

        return $this->display(__FILE__, 'views/templates/admin/product_tab.tpl');

    }

    public function postProcess() {
        if (Tools::isSubmit('submitAddproduct')
            || Tools::isSubmit('submitAddproductAndStay')){
                $id_product = Tools::getValue('id_product');
            if($id_product){
                $product = new Product($id_product);
                $has_combination = $product->hasAttributes();
                if($has_combination){


                }else{
                    $rel_row = Relation::getRowByProductId($id_product);
                    if($rel_row){
                        $relation = new Relation($rel_row['id_relations']);
                    } else {
                        $relation = new Relation();
                        $relation->id_product = $id_product;
                    }
                    $relation->id_provider= Tools::getValue('id_provider');
                    $relation->min_count = Tools::getValue('min_count');
                    $relation->product_count = Tools::getValue('product_count');
                    $relation->order_day = Tools::getValue('order_day');
                    $relation->name_combination = 0;
                    $relation->token = md5(uniqid(rand(), true));
                    $relation->save(true);
                }
            }
        }
    }


}