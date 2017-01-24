<?php
class Providers extends ObjectModel
{
    public $id_providers;

    public $name;

    public $description;

    public $email;


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'providers',
        'primary' => 'id_providers',
        'multilang' => false,
        'fields' => array(
            'id_providers' =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'name'         =>    array('type' => self::TYPE_STRING),
            'description'  =>    array('type' => self::TYPE_STRING),
            'email'        =>    array('type' => self::TYPE_STRING),
        ),
    );

    public static function getAll(){

        $db = Db::getInstance();

        $sql = "SELECT * FROM `"._DB_PREFIX_."providers`";

        if(!$result=$db->ExecuteS($sql)){
            return false;
        }
        return $result;
    }

    public  static function getCurrentProvider($id_provider){
        $db = Db::getInstance();

        $sql = "SELECT * FROM `"._DB_PREFIX_."providers` p WHERE p.`id_providers` =".$id_provider;

        if(!$result=$db->getRow($sql))
            return false;

        return $result;
    }

    public static function updateProvider(){
        $id_providers = Tools::getValue('id_provider');
        $description = Tools::getValue('description');
        $name = Tools::getValue('name');
        $email = Tools::getValue('email');

            $sql = "INSERT INTO "._DB_PREFIX_."providers
             (id_providers, name, description, email)
              VALUES(".$id_providers.",
               '".$name."', '".$description."',
               '".$email."' )
             ON DUPLICATE KEY UPDATE
            name='".$name."',
            description='".$description."',
            email='".$email."'
            ";

        if (!Db::getInstance()->execute($sql))
            return false;

        return true;
    }

    public static  function insertProviderReturnId()
    {
        $name = Tools::getValue('name');
        $description = Tools::getValue('description');
        $email = Tools::getValue('email');

        $sql = "INSERT INTO "._DB_PREFIX_."providers
             ( name, description, email)
              VALUES(
               '".$name."', '".$description."',
               '".$email."')";
        if (!Db::getInstance()->execute($sql))
            return false;
        $id_insert = Db::getInstance()->Insert_ID();
        return $id_insert;
    }


    public static function generateUrlStatus($id_provider, $id_product, $token){

        return $url = _PS_BASE_URL_.'/modules/autorestocking/status.php?provider='.$id_provider.'&product='.$id_product;

    }
}