<?php
class Providers extends ObjectModel
{
    public $id_providers;

    public $name;

    public $description;

    public $email;

//    public $order_day;

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
            /*'order_day'    =>    array('type' => self::TYPE_NOTHING)*/
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
}