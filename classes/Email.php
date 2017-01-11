<?php


class Email extends ObjectModel
{

    public $id_sent_email;

    public $provider_name;

    public $send_date;

    public $email;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'sent_email',
        'primary' => 'id_sent_email',
        'multilang' => false,
        'fields' => array(
            'id_sent_email' =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'provider_name'         =>    array('type' => self::TYPE_STRING, ),
            'send_date'        =>    array('type' => self::TYPE_STRING),
            'email'    =>    array('type' => self::TYPE_STRING)
        ),
    );


}