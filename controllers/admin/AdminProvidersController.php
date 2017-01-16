<?php

class AdminProvidersController extends ModuleAdminController {



    public function __construct()
    {
        $this->bootstrap = true;
        $this->required_database = true;
        $this->required_fields = array('name', 'description', 'email');
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



    public function renderForm()
    {
        $id_provider = Tools::getValue('id_providers');
        $all_categories = $id_provider ? Relation::getAllCategoryByProviderId($id_provider) : array();
        $categories = new HelperTreeCategories('categories-tree', 'Add category');
        $categories->setUseCheckBox(true)
           ->setSelectedCategories($all_categories);
        $categories->render();


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
                    'product_id' => (int)Tools::getValue('id_product')
                ));
        parent::renderForm();
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/provider_template.tpl');
    }



    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_PS_MODULE_DIR_.'autorestocking/views/js/provider.js');
        $this->context->controller->addJqueryPlugin('autocomplete');

    }
            
}