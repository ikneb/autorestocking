<?php
/**
 * 2016 WeeTeam
 *
 * @author    WeeTeam
 * @copyright 2016 WeeTeam
 * @license   http://www.gnu.org/philosophy/categories.html (Shareware)
 */

class AdminEmailController extends ModuleAdminController
{

    public function __construct()
    {
        $this->bootstrap = true;
        $this->required_database = true;
        $this->required_fields = array('provider_name', 'send_date', 'email');
        $this->table = 'sent_email';
        $this->className = 'Email';
        $this->lang = false;
        $this->context = Context::getContext();

        parent::__construct();

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'
            )
        );

        $this->allow_export = true;

        $this->fields_list = array(
            'id_sent_email' => array(
                'title' => $this->l('ID'),
                'align' => 'center'
            ),
            'provider_name' => array(
                'title' => $this->l('Name'),
                'align' => 'center'
            ),
            'email' => array(
                'title' => $this->l('Email'),
                'align' => 'center'
            ),
            'send_date' => array(
                'title' => $this->l('Date'),
                'align' => 'center'
            )
        );
    }
}
