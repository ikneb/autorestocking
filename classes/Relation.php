<?php
class Relation extends ObjectModel
{
    public $id_relations;

    public $id_product;

    public $id_category;

    public $id_provider;

    public $min_count;

    public $product_count;

    public $order_day;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'autorestocking_relations',
        'primary' => 'id_relations',
        'multilang' => false,
        'fields' => array(
            'id_relations'                 =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_product'         =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_category'         =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_provider'        =>    array('type' => self::TYPE_NOTHING, 'validate' => 'isNullOrUnsignedId'),
            'min_count'          =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'product_count'          =>    array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'order_day'    =>    array('type' => self::TYPE_NOTHING),

        ),
    );

    public static function getByProductId($id_product){
        $db = Db::getInstance();

        $sql = "SELECT * FROM `"._DB_PREFIX_."autorestocking_relations` r WHERE r.`id_product` =".$id_product;

        if(!$result=$db->getRow($sql))
            return false;

        return $result;
    }

    public static function getByProviderId($id_provider){
        $db = Db::getInstance();
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $sql = "SELECT r.id_relations,r.id_product,r.id_provider,r.min_count,r.product_count,r.order_day,p.name
        FROM "._DB_PREFIX_."autorestocking_relations r
        LEFT JOIN " . _DB_PREFIX_ . "product_lang p
        ON r.id_product = p.id_product
         WHERE r.id_provider =".$id_provider." AND id_lang=".$id_lang;

        if(!$result=$db->executeS($sql))
            return false;

        return $result;
    }

    public static function updateRelation($relaation_data){

            $sql = "UPDATE "._DB_PREFIX_."autorestocking_relations
                SET min_count = ".$relaation_data['min_count'].",
                order_day =  ".$relaation_data['order_day'].",
                product_count = ".$relaation_data['product_count']."
                WHERE id_relations = ".$relaation_data['id_relations'];

            if (!Db::getInstance()->execute($sql))
                return false;

            return true;

    }

    public static function updateRelationByProduct($relaation_data,$id_product){

            $sql = "UPDATE "._DB_PREFIX_."autorestocking_relations
                SET min_count = ".$relaation_data['min_count'].",
                order_day =  ".$relaation_data['order_day'].",
                product_count = ".$relaation_data['product_count']."
                WHERE id_product = ".$id_product;

            if (!Db::getInstance()->execute($sql))
                return false;

            return true;

    }

    public static function saveRelationByProvider($relation_data){

        if(!$relation_data)
            return false;
        $boxes = Tools::getValue('box');
        $product = Tools::getValue('product') ? Tools::getValue('product') : '';
        $id_provider = Tools::getValue('id_provider') ;

        $sql = 'SELECT id_category FROM '._DB_PREFIX_.'autorestocking_relations WHERE id_provider = 1';
        $categories = Db::getInstance()->executeS($sql);
        $all_category = array();
        foreach($categories as $categori){
            $all_category[] = $categori['id_category'];
        }
        if($product){
            $sql = 'INSERT INTO '._DB_PREFIX_.'autorestocking_relations
                 (id_product,id_provider)
                 VALUE ('.$product.','.$id_provider.')';
            if (!Db::getInstance()->execute($sql))
                return false;
        }
        if($boxes){
            foreach($boxes as $box){
                if(in_array($box,$all_category)){
                    continue;
                }else{
                    $sql = 'INSERT INTO '._DB_PREFIX_.'autorestocking_relations
                 (id_category,id_provider)
                 VALUE ('.$box.','.$id_provider.')';
                }

                if (!Db::getInstance()->execute($sql))
                    return false;
            }
        }

        return true;
    }

    public static function getAllCategoryByProviderId(){
        $id_provider = Tools::getValue('id_provider') ;

        $sql = 'SELECT id_category FROM '._DB_PREFIX_.'autorestocking_relations WHERE id_provider ='.$id_provider;
        $categories = Db::getInstance()->executeS($sql);
        $all_category = array();
        foreach($categories as $categori){
            $all_category[] = $categori['id_category'];
        }
        return json_encode(array_unique($all_category));
    }
}