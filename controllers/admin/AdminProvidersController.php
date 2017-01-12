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
//            'order_day' => array('title' => $this->l('Order day'), 'type' => 'select', 'list' => $this->weekdays, 'filter_key' => 'a!order_day', 'callback' => 'getDay')
        );

    }

    public function getDay($value){
        return $this->weekdays[$value];
    }

    public function renderForm()
    {

        if($id_provider = Tools::getValue('id_providers')){
        $provider = Providers::getCurrentProvider($id_provider);
            if(!$relations = Relation::getByProviderId($id_provider)){
                $relations = array();
            }
            $this->context->smarty->assign(
                array(
                    'id_providers' => $provider['id_providers'],
                    'name' => $provider['name'],
                    'description' => $provider['description'],
                    'email' => $provider['email'],
                    'token' => $this->token,
                    'relations' => $relations
                ));
        } else{

            $this->context->smarty->assign(
                array(
                    'token' => $this->token,
                    'id_providers' => '',
                    'name' => '',
                    'description' => '',
                    'email' => ''
                ));
        }
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/provider_template.tpl');
    }


    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_PS_MODULE_DIR_.'autorestocking/views/js/provider.js');
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