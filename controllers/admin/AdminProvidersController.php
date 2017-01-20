<?php

class AdminProvidersController extends ModuleAdminController {


    /** @var array providers list */
    protected $providers_array = array();

    public function __construct()
    {
        $this->bootstrap = true;
        $this->required_database = true;
        $this->required_fields = array('name','email', 'order_day');
        $this->table = 'providers';
        $this->className = 'Providers';
        $this->lang = false;
        $this->context = Context::getContext();
        /*$this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'
            )
        );*/


        parent::__construct();

    }

    public function initProcess()
    {
        parent::initProcess();

    }

    public function renderList(){
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?')
            )
        );

        $this->allow_export = false;

        $this->fields_list = array(
            'id_providers' => array('title' => $this->l('ID'), 'align' => 'center', 'class' => 'fixed-width-xs'),
            'name' => array('title' => $this->l('Name')),
            'description' => array('title' => $this->l('Description')),
            'email' => array('title' => $this->l('Email')),
        );

        return parent::renderList();
    }

    public function renderForm()
    {
        $id_provider = Tools::getValue('id_providers');
        $all_categories = $id_provider ? Relation::getAllCategoryByProviderId($id_provider) : array();
        $categories = new HelperTreeCategories('associated-categories-tree', 'Add category');
        $categories->setUseCheckBox(true);
        $categories->render();

        $provider = $id_provider ? Providers::getCurrentProvider($id_provider) : false;

            $this->context->smarty->assign(
                array(
                    'id_providers' => $provider ? $provider['id_providers'] : '',
                    'name' => $provider ? $provider['name'] : '',
                    'description' => $provider ? $provider['description'] : '',
                    'email' => $provider ? $provider['email'] : '',
                    'token' => $this->token,
                    'tree' => $categories,
                    'product_id' => (int)Tools::getValue('id_product')
                ));
        parent::renderForm();
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/provider_template.tpl');
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addCSS(_PS_MODULE_DIR_.'autorestocking/views/css/autorestocking.css','all');
        $this->context->controller->addJS(_PS_MODULE_DIR_.'autorestocking/views/js/provider.js');
        $this->context->controller->addJqueryPlugin('autocomplete');

    }

}