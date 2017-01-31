<?php
if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(_PS_MODULE_DIR_ . 'autorestocking/classes/Providers.php');
include_once(_PS_MODULE_DIR_ . 'autorestocking/classes/Relation.php');
include_once(_PS_MODULE_DIR_ . 'autorestocking/classes/Email.php');
include_once(_PS_MODULE_DIR_ . 'autorestocking/classes/EmailTemplate.php');

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
        if (!parent::install()
            || !$this->registerHook('actionAdminControllerSetMedia')
            || !$this->registerHook('displayAdminProductsExtra')
            || !$this->registerHook('displayHeader')
            || !Configuration::updateValue('PS_CRON_AUTORESTOCKING_METHOD', 1)
            || !Configuration::updateValue('PS_AUTOCRON_TIME', time())
            || !$this->addOrderState($this->l('Email sent(Autorestockin)'), '#4169E1')
            || !$this->addOrderState($this->l('In process(Autorestockin)'), '#FF8C00')
            || !$this->addOrderState($this->l('Order sent(Autorestockin)'), '#32CD32')
        ) {
            return false;
        }

        $this->installDb();

        $parent_tab = new Tab();
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

        $tab = new Tab();
        $tab->name[$this->context->language->id] = $this->l('Settings');
        $tab->class_name = 'SettingsAutorestocking';
        $tab->id_parent = $parent_tab->id;
        $tab->module = $this->name;
        $tab->add();

        return true;
    }

    public function installDb()
    {
        $sql = array();
        include(dirname(__FILE__) . '/sql/install.php');
        foreach ($sql as $s) {
            if (!Db::getInstance()->execute($s)) {
                return false;
            }
        }
        return true;
    }

    public function uninstall()
    {
        $sql = array();
        include(dirname(__FILE__) . '/sql/uninstall.php');
        foreach ($sql as $s) {
            if (!Db::getInstance()->execute($s)) {
                return false;
            }
        }

        if (!parent::uninstall()
            || !Configuration::deleteByName('PS_CRON_AUTORESTOCKING_METHOD')
            || !Configuration::deleteByName('PS_AUTOCRON_TIME')
        ) {
            return false;
        }

        Tab::disablingForModule($this->name);

        return true;
    }

    public function hookActionAdminControllerSetMedia($params)
    {
        if ($this->context->controller->controller_name == 'AdminProducts') {
            $this->context->controller->addCss($this->_path . 'views/css/autorestocking.css');
            $this->context->controller->addJquery();
            $this->context->controller->addJS($this->_path . 'views/js/product_tab.js');
        }

    }

    public function hookDisplayHeader()
    {
        $time = Configuration::get('PS_AUTOCRON_TIME');
        $current_time = time();
        $dif = $current_time - $time;
        if ($dif > 10 && Configuration::get('PS_CRON_AUTORESTOCKING_METHOD') == 1) {
            $time = Configuration::updateValue('PS_AUTOCRON_TIME', time());
            self::autoCron();
        }
    }

    public function hookDisplayAdminProductsExtra($params)
    {

        $this->context->controller->addCss($this->_path . 'views/css/autorestocking.css');
        $this->context->controller->addJquery();
        $this->context->controller->addJS($this->_path . 'views/js/product_tab.js');

        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            $id_product = Tools::getValue('id_product');
        } else {
            $id_product = Tools::getValue('id_product', $params['id_product']);
        }

        $product = new Product($id_product);
        $id_category_default = $product->id_category_default;
        $has_combination = $product->hasAttributes();
        $providers = Providers::getAll();

        $autorestocking = $has_combination ? Relation::getAllByProductId($id_product) : Relation::getRowByProductId($id_product);

        $combination = $autorestocking ? Relation::getCombinationAndReelation($id_product) : Relation::getAttributeByIdProduct($id_product);
        $this->smarty->assign(array(
            'providers' => $providers,
            'relations' => $autorestocking,
            'has_combination' => $has_combination,
            'has_comb_tpl' => _PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/has_comb.tpl',
            'not_comb_tpl' => _PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/not_comb.tpl',
            'has_comb_tpl_new' => _PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/has_comb_new.tpl',
            'not_comb_tpl_new' => _PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/not_comb_new.tpl',
            'combinations' => $combination,
            'version' => version_compare(_PS_VERSION_, '1.7', '<'),
            'id_product' => $id_product,
            'id_category_default' => $id_category_default

        ));

        return $this->display(__FILE__, 'views/templates/admin/product_tab.tpl');

    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitAddproduct')
            || Tools::isSubmit('submitAddproductAndStay')
        ) {
            $id_product = Tools::getValue('id_product');
            if ($id_product) {
                $product = new Product($id_product);
                $has_combination = $product->hasAttributes();
                if ($has_combination) {


                } else {
                    $rel_row = Relation::getRowByProductId($id_product);
                    if ($rel_row) {
                        $relation = new Relation($rel_row['id_relations']);
                    } else {
                        $relation = new Relation();
                        $relation->id_product = $id_product;
                    }
                    $relation->id_provider = Tools::getValue('id_provider');
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

    public static function updateConfig()
    {
        if (!Configuration::updateValue('PS_CRON_AUTORESTOCKING_METHOD', Tools::getValue('method_value'))) {
            return false;
        }
        return true;
    }


    public function addOrderState($name, $color)
    {
        $state_exist = false;
        $states = OrderState::getOrderStates((int)$this->context->language->id);


        foreach ($states as $state) {
            if (in_array($name, $state)) {
                $state_exist = true;
                break;
            }
        }

        if (!$state_exist) {
            $order_state = new OrderState();
            $order_state->color = $color;
            $order_state->module_name = 'autorestocking';
            $order_state->name = array();
            $languages = Language::getLanguages(false);
            foreach ($languages as $language) {
                $order_state->name[$language['id_lang']] = $name;
            }
            $order_state->add();
        }

        return true;
    }

    public static function autoCron()
    {
        $all_provider = Providers::getAll();

        if (is_array($all_provider)) {
            foreach ($all_provider as $provider) {
                $relations = Relation::getByProviderId($provider['id_providers'], 0, 1000);
                $count_current_month = date('t');
                if (!empty($relations)) {
                    $product_list = array();
                    foreach ($relations as $relation) {
                        $order_day = Tools::jsonDecode($relation['order_day']);
                        $type_data_order = $relation['type_order_day'];
                        $type_data = ($type_data_order == 1) ? date('w') : date('j');
                        if($type_data > $count_current_month ){
                            $type_data = $count_current_month;
                        }
                        if ($relation['id_product_attribute'] != 0 && $relation['id_product_attribute'] != 999999999) {
                            if ($relation['min_count'] >= $relation['attribute_quantity']
                                || $order_day == $type_data
                            ) {
                                $product_list[] = $relation;
                            }
                        } else {
                            if ($relation['min_count'] >= $relation['product_quantity']
                                || $order_day == $type_data
                            ) {
                                $product_list[] = $relation;
                            }
                        }
                    }
                    $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
                    $sql = "SELECT id_order_state FROM " . _DB_PREFIX_ . "order_state_lang WHERE id_lang ="
                        . $id_lang . " AND name ='Email sent(Autorestockin)'";
                    $id_order_state = Db::getInstance()->getValue($sql);


                    if (!empty($product_list)) {
                        $token = md5(uniqid(rand(), true));

                        $order = new OrderCore();
                        $order->current_state = $id_order_state;
                        $order->id_address_delivery = 0;
                        $order->id_shop = 1;
                        $order->id_address_invoice = 0;
                        $order->id_cart = 0;
                        $order->id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
                        $order->id_customer = 0;
                        $order->id_carrier = 0;
                        $order->payment = 'Payment by check';
                        $order->module = 'cheque';
                        $order->total_paid = 0;
                        $order->total_paid_real = 0;
                        $order->total_products = 0;
                        $order->total_products_wt = 0;
                        $order->conversion_rate = 0;
                        $order->secure_key = 0;
                        $order->add();

                        $email = new Email();
                        $email->provider_name = $provider['name'];
                        $email->email = $provider['email'];
                        $email->send_date = date("Y-m-d H:i:s");
                        $email->token = $token;
                        $email->id_order = $order->getFields()['id_order'];
                        $email->id_state = $order->getFields()['current_state'];
                        $email->save();

                        $email->getID($token);

                        $message = self::generateMessage($provider['id_providers'], $provider['name'], $product_list,
                            $token, $order->getFields()['id_order'],  $email->getID($token));
                        print_r($message);

                        $send = Email::sendEmail($provider['email'], $message);

                        if($message && $send){
                            return true;
                        }else {
                            $email->delete();
                            $order->delete();
                        }
                    }
                }
            }
        }
    }

    public static function generateUrlStatus($id_provider, $token, $id_order, $id_sent_email)
    {
        return $url = _PS_BASE_URL_ . '/modules/autorestocking/status.php?provider=' . $id_provider
            . '&token=' . $token . '&id_order=' . $id_order . '&id_email=' . $id_sent_email;
    }

    public static function generateMessage($id_provider, $name, $product_list, $token, $id_order, $id_sent_email)
    {
        $list = '';

        foreach ($product_list as $product) {
            $combination = $product['id_product_attribute'] ? ':(' . $product['name_combination'] . ')' : '';
            $list .= "<p>" . $product['name'] . $combination . "   count order : " . $product['product_count'] . " </p>";
        }

        $url_status = self::generateUrlStatus($id_provider, $token, $id_order, $id_sent_email);
        $message = EmailTemplate::getMailTemplate();

        if ($message) {
            $message = preg_replace('/\[name\]/', $name, $message);
            $message = preg_replace('/\[status_url\]/', $url_status, $message);
            $message = preg_replace('/\[product_list\]/', $list, $message);
            return $message;
        }

        return false;

    }

    public static function changeStatus()
    {
        $status = Tools::getValue('status');
        $id_povider = Tools::getValue('id_povider');
        $id_product = Tools::getValue('id_product');
        $id_order = Tools::getValue('id_order');
        $id_email = Tools::getValue('id_email');
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');


        switch ($status) {
            case 1:

                $sql = "SELECT id_order_state FROM " . _DB_PREFIX_ . "order_state_lang WHERE id_lang ="
                    . $id_lang . " AND name ='In process(Autorestockin)'";
                $id_order_state = Db::getInstance()->getValue($sql);

                $history = new OrderHistory();
                $history->id_order = (int)$id_order;
                $history->changeIdOrderState($id_order_state, (int)$id_order);

                return 1;

                break;
            case 2:
                $sql = "SELECT id_order_state FROM " . _DB_PREFIX_ . "order_state_lang WHERE id_lang ="
                    . $id_lang . " AND name ='Order sent(Autorestockin)'";
                $id_order_state = Db::getInstance()->getValue($sql);

                $history = new OrderHistory();
                $history->id_order = (int)$id_order;
                $history->changeIdOrderState($id_order_state, (int)$id_order);

                $sql = "UPDATE " . _DB_PREFIX_ . "sent_email
                SET token = 0
                WHERE id_sent_email = " . $id_email;

                Db::getInstance()->execute($sql);

                return 2;

                break;
        }

        return false;
    }
}