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
        $this->context->controller->addCss($this->_path.'css/autorestocking.css');
    }

    public function hookDisplayAdminProductsExtra() {

        $id_product = Tools::getValue('id_product');
        $providers = Providers::getAll();
        $autorestocking = Relation::getByProductId($id_product);

        $fields_form[0]['form'] = array(
            'input' => array(
                array(
                    'type' => 'text',
                    'name' => 'shipping_method',
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        $this->smarty->assign(array(
            'providers' => $providers,
            'autorestocking' => $autorestocking
        ));
        return $this->display(__FILE__, 'views/templates/admin/product_tab.tpl');
    }

    public function postProcess() {
        if (Tools::isSubmit('submitAddproduct')
            || Tools::isSubmit('submitAddproductAndStay')){
            $id_product = Tools::getValue('id_product');
            if($id_product){
                $rel_row = Relation::getByProductId($id_product);
                if($rel_row){
                    $relation = new Relation($rel_row['id']);
                } else {
                    $relation = new Relation();
                    $relation->product_id = $id_product;
                }
                $relation->provider_id = Tools::getValue('provider');
                $relation->min_count = Tools::getValue('min_count');
                $relation->save(true);
            }
        }
    }


}