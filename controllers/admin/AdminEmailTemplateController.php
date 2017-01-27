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

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'autorestocking/views/js/autorest.js');
    }

    public function renderList()
    {
        $form = $this->renderForm();
        // To load form inside your template
        $this->context->smarty->assign('form_tpl', $form);
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/email_template.tpl');

    }

    public function renderForm()
    {

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->module->l('Edit template email'),
                    'icon' => 'icon-envelope',
                ),
                'input' => array(
                    array(
                        'type' => 'textarea',
                        'name' => 'template_email',
                        'required' => false,
                        'autoload_rte' => true,
                        'col' => '5',
                        'desc' => $this->module->l('If you want insert name provider, status URL or product list in the mail, you need use shortcode [name],[status_url] or [product_list]!'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save'),
                    'id' => 'template_email'
                ),
            ),
        );

        $sql = 'SELECT template_email FROM ' . _DB_PREFIX_ . 'template_email
         WHERE id_template_email=1';
        $template = DB::getInstance()->getValue($sql);


        $helper = new HelperForm();
        $helper->table = 'template_email';
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => array(
                'template_email' => $template,
            ),
            'languages' => $this->context->controller->getLanguages(),
        );

        return $helper->generateForm(array($fields_form));

    }

}
