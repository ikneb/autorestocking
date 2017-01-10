<?php

class AdminEmailTemplateController extends ModuleAdminController
{
    public function __construct()
    {

        $this->bootstrap = true;
        $this->required_database = true;
        $this->required_fields = array('id_template_email', 'template_email');
        $this->table = 'template_email';
        $this->className = 'EmailTemplate';
        $this->lang = false;
        $this->context = Context::getContext();



        parent::__construct();

    }

    public function display()
    {
        parent::display();
    }

    public function renderList()
    {
        $form = $this->renderForm();

        // To load form inside your template
        $this->context->smarty->assign('form_tpl', $form);
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/email_template.tpl');

    }

    public function renderForm(){

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->module->l('Edit template email'),
                    'icon' => 'icon-envelope',
                ),
                'input' => array(
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Add template email'),
                        'name' => 'template_email',
                        'required' => false,
                        'autoload_rte' => true,
                        'desc' => $this->module->l('!!!!!!!!!!!!!!!'),
                    ),
                ),
                'submit' => array('title' => $this->module->l('Save')),
            ),
        );

        $helper = new HelperForm();
        $helper->table = 'template_email';
        $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => array(
                'template_email' => '',
            ),
            'languages' => $this->context->controller->getLanguages(),
        );

        return $helper->generateForm(array($fields_form));

    }
}
