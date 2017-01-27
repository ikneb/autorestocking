<?php

/**
 * Created by PhpStorm.
 * User: junta
 * Date: 1/27/17
 * Time: 10:25 AM
 */
class SettingsAutorestockingController extends AdminController
{

    public function __construct()
    {
        $this->bootstrap = true;
        parent::__construct();
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_PS_MODULE_DIR_.'autorestocking/views/js/autorest.js');
    }


    public function renderList()
    {
        $form = $this->renderForm();
        // To load form inside your template
        $this->context->smarty->assign('form_tpl', $form);
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/setting.tpl');

    }

    public function renderForm(){

        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

            $fields_form[0]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-briefcase'
                ),
                'input' => array(

                    array(
                        'type' => 'radio',
                        'label' => $this->l('Template compilation'),
                        'name' => 'cron_autorestocking_method',
                        'values' => array(
                            array(
                                'id' => 'cron_autorestocking_method_1',
                                'value' => 1,
                                'label' => $this->l('Auto cron'),
                                'hint' => $this->l('Info')
                            ),
                            array(
                                'id' => 'cron_autorestocking_method_2',
                                'value' => 2,
                                'label' => $this->l('Cron'),
                                'hint' => $this->l('Info')
                            )
                        )
                    ),

                ),
                'submit' => array(
                    'title' => $this->l('Save')
                )
            );

        $helper = new HelperForm();
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submitCmsReadMore';


        $helper->fields_value['cron_autorestocking_method'] = Configuration::get('PS_CRON_AUTORESTOCKING_METHOD');


        return $helper->generateForm($fields_form);

    }

}