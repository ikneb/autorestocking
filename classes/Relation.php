<?php
class Relation extends ObjectModel
{
    public $id;

    public $product_id;

    public $provider_id;

    public $min_count;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'autorestocking_relations',
        'primary' => 'id',
        'multilang' => false,
        'fields' => array(
            'id'                 =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'product_id'         =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'provider_id'        =>    array('type' => self::TYPE_NOTHING, 'validate' => 'isNullOrUnsignedId'),
            'min_count'          =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
        ),
    );

    public static function getByProductId($product_id){
        $db = Db::getInstance();

        $sql = "SELECT * FROM `"._DB_PREFIX_."autorestocking_relations` r WHERE r.`product_id` =".$product_id;

        if(!$result=$db->getRow($sql))
            return false;

        return $result;
    }
}