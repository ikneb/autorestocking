<?php

class AdminProvidersController extends ModuleAdminController {

    /** @var array providers list */
    protected $providers_array = array();

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
        /*$weekdays_options = array();
        foreach ($this->weekdays as $key => $day){
            $weekdays_options[$key]['id_option'] = $key;
            $weekdays_options[$key]['name'] = $day;
        }*/

        $this->available_tabs_lang = array(
            'Provide' => $this->l('Provide'),
            'Relation' => $this->l('Relation'),
        );

        $this->available_tabs = array('Quantities' => 6, 'Warehouses' => 14);
        if ($this->context->shop->getContext() != Shop::CONTEXT_GROUP) {
            $this->available_tabs = array_merge($this->available_tabs, array(
                'Provide' => 0,
                'Relation' => 1,
            ));
        }

        asort($this->available_tabs, SORT_NUMERIC);

        /* Adding tab if modules are hooked */
        $modules_list = Hook::getHookModuleExecList('displayAdminProductsExtra');
        if (is_array($modules_list) && count($modules_list) > 0) {
            foreach ($modules_list as $m) {
                $this->available_tabs['Module'.ucfirst($m['module'])] = 23;
                $this->available_tabs_lang['Module'.ucfirst($m['module'])] = Module::getModuleName($m['module']);
            }
        }


        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Providers'),
                'icon' => 'icon-briefcase'
            ),
            'input' => array(
                array(
                    'type' => 'text_customer',
                    'label' => $this->l('Provider'),
                    'name' => 'id_customer',
                    'required' => false,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Name'),
                    'name' => 'name',
                    'required' => true,
                    'col' => '3'
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description'),
                    'name' => 'description',
                    'required' => false,
                    'col' => '3'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Email'),
                    'name' => 'email',
                    'required' => true,
                    'col' => '3',
                    'hint' => $this->l('Invalid characters:').' &lt;&gt;;=#{}'
                ),
                /*array(
                    'type' => 'select',
                    'label' => $this->l('Order day'),
                    'name' => 'order_day',
                    'required' => false,                               // If set to true, this option must be set.
                    'options' => array(
                        'query' => $weekdays_options,                  // $options contains the data itself.
                        'id' => 'id_option',                           // The value of the 'id' key must be the same as the key for 'value' attribute of the <option> tag in each $options sub-array.
                        'name' => 'name'                               // The value of the 'name' key must be the same as the key for the text content of the <option> tag in each $options sub-array.
                    ),
                    'col'  => 3,
                )*/
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            )
        );

        return parent::renderForm();
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