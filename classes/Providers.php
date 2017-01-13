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

    public static function updateProvider($provider_data){

            $sql = "INSERT INTO "._DB_PREFIX_."providers
             (id_providers, name, description, email)
              VALUES(".$provider_data['id_providers'].",
               '".$provider_data['name']."', '".$provider_data['description']."',
               '".$provider_data['email']."' )
             ON DUPLICATE KEY UPDATE
            name='".$provider_data['name']."',
            description='".$provider_data['description']."',
            email='".$provider_data['email']."'
            ";

        if (!Db::getInstance()->execute($sql))
            return false;

        return true;
    }

    public static  function insertProviderReturnId($provider_data)
    {

        $sql = "INSERT INTO "._DB_PREFIX_."providers
             ( name, description, email)
              VALUES(
               '".$provider_data['name']."', '".$provider_data['description']."',
               '".$provider_data['email']."')";

        if (!Db::getInstance()->execute($sql))
            return false;

        $id_insert = Db::getInstance()->Insert_ID();


        return $id_insert;
    }

    public static function getLight($id_lang, $id_product, Context $context = null)
    {
        if (!$context)
            $context = Context::getContext();

        $sql = 'SELECT `id_product`,`name`
                    FROM `'._DB_PREFIX_.'product_lang`
                    WHERE `id_lang` = '.(int)$id_lang;

        return Db::getInstance()->executeS($sql);
    }

}