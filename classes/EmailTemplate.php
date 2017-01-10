<?php


class EmailTemplate extends ObjectModel
{

    public $id_template_email;
    public $template_email;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'template_email',
        'primary' => 'id_template_email',
        'multilang' => false,
        'fields' => array(
            'id_template_email' =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'template_email'         =>    array('type' => self::TYPE_STRING, )
        ),
    );


    public function getTemplate(){

    }
}