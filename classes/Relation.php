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

    public $status;

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
            'status'    =>    array('type' => self::TYPE_INT),
        ),
    );

    public static function getByProductId(){
        $id_product = Tools::getValue('id_product');
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

    public static function saveRelationProductByProvider(){
        $id_provider = Tools::getValue('id_provider');
        $id_product = Tools::getValue('id_product');

        $sql = 'INSERT INTO '._DB_PREFIX_.'autorestocking_relations
                         (id_provider,id_product)
                         VALUE ('.$id_provider.','.$id_product.')
                        ON DUPLICATE KEY UPDATE id_product = id_product';
        if(!Db::getInstance()->execute($sql))
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

    public static function saveRelationCategoryByProvider(){

        $boxes = Tools::getValue('box');
        $id_provider = Tools::getValue('id_provider') ;

        $sql = 'SELECT id_category FROM '._DB_PREFIX_.'autorestocking_relations WHERE id_provider ='.$id_provider;
        $categories = Db::getInstance()->executeS($sql);
        $all_category = array();
        foreach($categories as $categori){
            $all_category[] = $categori['id_category'];
        }
        if($boxes){
            foreach($boxes as $box){
                Relation::setProductByCategoryId($box['id_category'], $id_provider );
            }
        }
        foreach ($all_category as $category){
            if(!in_array($category, $boxes)){
                $sql = 'DELETE FROM '._DB_PREFIX_.'autorestocking_relations 
                WHERE id_provider ='.$id_provider.' AND id_category = '.$category;
            }
            if (!Db::getInstance()->execute($sql))
                return false;
        }

        return true;
    }

    public static  function setProductByCategoryId($id_category, $id_provider){
        $sql = 'INSERT INTO '._DB_PREFIX_.'autorestocking_relations
                         (id_provider,id_category)
                         VALUE ('.$id_provider.','.$id_category.')';
        Db::getInstance()->execute($sql);

        $sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE id_category_default ='. $id_category;
        $products = Db::getInstance()->executeS($sql);
        if(!empty($products)){
            foreach($products as $product){
                $sql = 'INSERT INTO '._DB_PREFIX_.'autorestocking_relations
                 (id_provider,id_category,id_product)
                 VALUE ('.$id_provider.','.$id_category.','.$product['id_product'].')';
                Db::getInstance()->execute($sql);
            }
        }

        return true;
    }


    public static function getAllCategoryByProviderId($id_provider){

        $sql = 'SELECT id_category FROM '._DB_PREFIX_.'autorestocking_relations WHERE id_provider ='.$id_provider;
        $categories = Db::getInstance()->executeS($sql);
        $all_category = array();
        foreach($categories as $categori){
            $all_category[] = $categori['id_category'];
        }
        return $all_category;
    }

    public  static function getAllProductByProviderId($smarty){
        $id_provider = Tools::getValue('id_provider');

        $relations = Relation::getByProviderId($id_provider);
       $smarty->assign('relations', $relations);

        return $smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/view_relation.tpl');
    }

    
    public static function updateRelation(){
        $min_count = Tools::getValue('min_count');
        $order_day = Tools::getValue('order_day');
        $product_count = Tools::getValue('product_count');
        $id_relations = Tools::getValue('id_relations');

        $sql = "UPDATE "._DB_PREFIX_."autorestocking_relations
                SET min_count = ".$min_count.",
                order_day =  ".$order_day.",
                product_count = ".$product_count."
                WHERE id_relations = ".$id_relations;
        if (!Db::getInstance()->execute($sql))
            return false;
        return true;
    }

    public  function checkProduct(){

    }

    public static function getAllRelation(){
        $sql = 'SELECT r.id_relations, r.id_product, r.id_provider, r.min_count,
        r.product_count, r.order_day, p.name, p.email FROM
        '._DB_PREFIX_.'autorestocking_relations r
        LEFT JOIN '._DB_PREFIX_.'providers p
        ON  r.id_provider = p.id_providers ';

        return Db::getInstance()->executeS($sql);
    }


    public static function changeStatus(){
        $status = Tools::getValue('status');
        $id_povider = Tools::getValue('id_povider');
        $id_product = Tools::getValue('id_product');

        $sql = 'UPDATE '._DB_PREFIX_.'autorestocking_relations
                SET status= '.$status.'
                WHERE  id_product = '. $id_product;
        if (!Db::getInstance()->execute($sql))
            return false;

        return true;
    }
}
