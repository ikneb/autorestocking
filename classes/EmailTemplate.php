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


    public static function updateTemplate($template_email){
            $sql = "INSERT INTO "._DB_PREFIX_."template_email
             (id_template_email, template_email)
              VALUES(1, '".$template_email."')
             ON DUPLICATE KEY UPDATE
            template_email='".$template_email."'";
        if (!Db::getInstance()->execute($sql))
            return false;
        return true;
    }


    public static function generateMessage($id_provider,$name,$id_product){


        $url_status = Providers::generateUrlStatus($id_provider,$id_product);
        $sql  = 'SELECT template_email FROM '._DB_PREFIX_.'template_email WHERE id_template_email = 1';
        $message = Db::getInstance()->getRow($sql);
        $message = $message['template_email'];
        $message = preg_replace('/\[name\]/',$name,$message);
        $message = preg_replace('/\[status_url\]/',$url_status,$message);


        return $message;
    }
}