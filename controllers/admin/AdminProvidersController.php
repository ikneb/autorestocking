<?php

class AdminProvidersController extends ModuleAdminController {


    private $weekdays = array(
        0 => ' ',
        1 => 'Mon',
        2 => 'Tue',
        3 => 'Wed',
        4 => 'Thu',
        5 => 'Fri',
        6 => 'Sat',
        7 => 'Sun'
    );

    public function __construct()
    {
        $this->bootstrap = true;
        $this->required_database = true;
        $this->required_fields = array('name', 'description', 'email'/*, 'order_day'*/);
        $this->table = 'providers';
        $this->className = 'Providers';
        $this->lang = false;
        $this->context = Context::getContext();
        $this->allow_export = true;
        $this->explicitSelect = true;

        parent::__construct();

        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'
            )
        );

        $this->fields_list = array(
            'id_providers' => array('title' => $this->l('ID'), 'align' => 'center', 'class' => 'fixed-width-xs'),
            'name' => array('title' => $this->l('Name'), 'filter_key' => 'a!name'),
            'description' => array('title' => $this->l('Description')),
            'email' => array('title' => $this->l('Email'), 'filter_key' => 'a!email'),
        );

    }

    public function getDay($value){
        return $this->weekdays[$value];
    }

    public function renderForm()
    {


        $categories = new HelperTreeCategories('categories-tree', 'Add category');
        $categories->setUseCheckBox(true);
        $categories->render();
        $my_associations = Providers::getLight($this->context->language->id,Tools::getValue('id_product'));
        $id_provider = Tools::getValue('id_providers');

        $provider = $id_provider ? Providers::getCurrentProvider($id_provider) : false;


            if(!$provider){
                $relations = array();
            }else{
                $relations = Relation::getByProviderId($id_provider);
            }

            $this->context->smarty->assign(
                array(
                    'id_providers' => $provider ? $provider['id_providers'] : '',
                    'name' => $provider ? $provider['name'] : '',
                    'description' => $provider ? $provider['description'] : '',
                    'email' => $provider ? $provider['email'] : '',
                    'token' => $this->token,
                    'relations' => $relations,
                    'tree' => $categories,
                    'my_associations' => $my_associations,
                    'product_id' => (int)Tools::getValue('id_product')
                ));
        parent::renderForm();
        $this->addJqueryPlugin(array('autocomplete', 'fancybox', 'typewatch'));

        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/provider_template.tpl');
    }



    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_PS_MODULE_DIR_.'autorestocking/views/js/provider.js');
        $this->context->controller->addJqueryPlugin('autocomplete');
    }

    public function processDelete()
    {

        $res = parent::processDelete();
        return $res;
    }

    public function processAdd()
    {
        if (Tools::getValue('submitFormAjax')) {
            $this->redirect_after = false;
        }

        return parent::processAdd();
    }
}