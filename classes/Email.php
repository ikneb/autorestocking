<?php


class Email extends ObjectModel
{

    public $id_sent_email;

    public $provider_name;

    public $send_date;

    public $email;

    public $token;

    public $id_order;

    public $id_state;


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'sent_email',
        'primary' => 'id_sent_email',
        'multilang' => false,
        'fields' => array(
            'id_sent_email' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'provider_name' => array('type' => self::TYPE_STRING,),
            'send_date' => array('type' => self::TYPE_STRING),
            'email' => array('type' => self::TYPE_STRING),
            'token' => array('type' => self::TYPE_STRING),
            'id_order' => array('type' => self::TYPE_INT),
            'id_state' => array('type' => self::TYPE_INT),
        ),
    );


    public static function sendEmail($to, $message)
    {
        $shop_email = Configuration::get('PS_SHOP_EMAIL');
        $shop_name = Configuration::get('PS_SHOP_NAME');
        $subject = 'New order';
        $headers = 'Content-type: text/html; charset=windows-1251 \r\n';
        $headers .= 'From: ' . $shop_name . ' <' . $shop_email . '>\r\n';
        mail($to, $subject, $message, $headers);

        return true;
    }

    public function getID($token){

        $sql = $sql = 'SELECT id_sent_email FROM
        ' . _DB_PREFIX_ . 'sent_email
        WHERE token ="' . $token.'"';
        $id_sent_email = Db::getInstance()->getValue($sql);

        return $id_sent_email;

    }
}