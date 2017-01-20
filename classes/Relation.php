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

    public $token;

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
            'token'    =>    array('type' => self::TYPE_STRING),
        ),
    );

    public static function getByProductId($id_product){
        $db = Db::getInstance();
        $sql = "SELECT * FROM `"._DB_PREFIX_."autorestocking_relations` r WHERE r.`id_product` =".$id_product;

        if(!$result=$db->getRow($sql))
            return false;

        return $result;
    }

    public static function getByProviderId($id_provider, $offset, $limit){
        $db = Db::getInstance();
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $sql = "SELECT r.id_relations,r.id_product,r.id_provider,r.min_count,
        r.product_count,r.order_day,l.name,p.quantity
        FROM "._DB_PREFIX_."autorestocking_relations r
        LEFT JOIN " . _DB_PREFIX_ . "product p
        ON r.id_product = p.id_product
        LEFT JOIN " . _DB_PREFIX_ . "product_lang l
        ON p.id_product = l.id_product
        WHERE r.id_provider =".$id_provider." AND id_lang=".$id_lang. " LIMIT ".$limit." OFFSET ".$offset;

        if(!$result=$db->executeS($sql))
            return false;

        return $result;
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
        $limit = 5;
        $id_provider = Tools::getValue('id_provider');
        $page = (int)(Tools::getValue('page') ? Tools::getValue('page') : 1) ;
        $count_relation = Db::getInstance()->query(
            'SELECT * FROM '._DB_PREFIX_.'autorestocking_relations
             WHERE id_provider ='. $id_provider)->rowCount();
        if($count_relation % $limit == 0){
            $pages =$count_relation / $limit;
        }else{
            $pages = ceil($count_relation / $limit);
        }
        $offset =($page == 1) ? 0 : $limit * ($page-1);

        $relations = self::getByProviderId($id_provider,$offset,$limit);
        $smarty->assign(array(
            'relations'=> $relations,
            'pages'=>$pages,
            'select' =>$page
            ));

            return $smarty->fetch(_PS_MODULE_DIR_.'autorestocking/views/templates/admin/view_relation.tpl');
    }

    
    public static function updateRelation(){
        $min_count = Tools::getValue('min_count');
        $order_day = Tools::getValue('order_day') + 1;
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

    public static function getProductByCategoryId($id_category){

        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $sql = 'SELECT p.id_product,p.id_category_default, pl.name FROM '._DB_PREFIX_.'product p
        LEFT JOIN '._DB_PREFIX_.'product_lang pl
        ON p.id_product=pl.id_product
        WHERE p.id_category_default='.$id_category.' AND pl.id_lang='.$id_lang;

        return Db::getInstance()->executeS($sql);
    }

    public static function getProductsAllCategories(){
        $result = array();
        $categories = Tools::getValue('categories');
        foreach ($categories as $category ) {
            $product = self::getProductByCategoryId($category);
            if(!empty($product)) {
                if(count($product)>1){
                    foreach ($product as $prod) {
                        $result[][0] = $prod;
                    }
                }else{
                    $result[] = $product;
               }
            }
        }
        return $result;
    }

    public static function saveRelationProductByProvider(){
        $products = Tools::getValue('products');
        $id_provider = Tools::getValue('id_provider');
        $sql = $sql = 'SELECT id_product FROM
        '._DB_PREFIX_.'autorestocking_relations
        WHERE id_provider ='. $id_provider ;
        $all_product = Db::getInstance()->executeS($sql);
        $change_product = array();
        foreach ($all_product as $product) {
            $change_product[] = $product['id_product'];
        }
        if(!empty($products)){
            foreach ($products as $product ) {
                if(!in_array($product['id_product'],$change_product)) {
                    $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'autorestocking_relations
                    ( id_product, id_category, id_provider,token)
                    VALUES(
                   ' . $product['id_product'] . ', ' . $product['id_category'] . ',
                   ' . $product['id_provider'] . ',"' . md5(uniqid(rand(), true)) . '")';

                    if (!Db::getInstance()->execute($sql))
                        return false;
                }
            }
        }else{
            return false;
        }
        return $change_product;
    }

    public static function getCategoryIdByProduct(){
        $id_product = Tools::getValue('id_product');
        $sql = $sql = 'SELECT id_category_default FROM
        '._DB_PREFIX_.'product
        WHERE id_product ='. $id_product ;
        $id_category = Db::getInstance()->getRow($sql);

        return $id_category['id_category_default'];
    }

    public static function deleteRelationByIdRelation(){
        $id_relation = Tools::getValue('id_relation');

        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'autorestocking_relations
         WHERE id_relations ='.$id_relation;

        if (!Db::getInstance()->execute($sql))
            return false;

        return true;
    }


}
