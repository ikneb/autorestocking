<?php

class Relation extends ObjectModel
{

    public $id_relations;

    public $id_product;

    public $id_category;

    public $id_provider;

    public $id_attribute;

    public $name_combination;

    public $min_count;

    public $product_count;

    public $type_order_day;

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
            'id_relations' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_category' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_provider' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_product_attribute' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'name_combination' => array('type' => self::TYPE_STRING),
            'min_count' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'product_count' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'type_order_day' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'order_day' => array('type' => self::TYPE_NOTHING),
            'status' => array('type' => self::TYPE_INT),
        ),
    );

    public static function getRowByProductId($id_product)
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM `" . _DB_PREFIX_ . "autorestocking_relations` WHERE `id_product` =" . $id_product;

        if (!$result = $db->getRow($sql)) {
            return false;
        }

        return $result;
    }

    public static function getAllByProductId($id_product)
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM `" . _DB_PREFIX_ . "autorestocking_relations` WHERE `id_product` =" . $id_product;

        if (!$result = $db->executeS($sql)) {
            return false;
        }

        return $result;
    }

    public static function getByProviderId($id_provider, $offset, $limit)
    {
        $db = Db::getInstance();
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $sql = "SELECT r.id_relations,r.id_product,r.id_provider, r.min_count, r.id_product_attribute, r.name_combination,
        r.product_count, r.order_day, r.type_order_day, l.name, ps.quantity AS product_quantity, pa.quantity AS attribute_quantity
        FROM " . _DB_PREFIX_ . "autorestocking_relations r
        LEFT JOIN " . _DB_PREFIX_ . "product p
        ON r.id_product = p.id_product 
        LEFT JOIN " . _DB_PREFIX_ . "stock_available ps
        ON p.id_product = ps.id_product
        LEFT JOIN " . _DB_PREFIX_ . "product_lang l
        ON p.id_product = l.id_product
        LEFT JOIN " . _DB_PREFIX_ . "product_attribute pa
        ON pa.id_product_attribute = r.id_product_attribute
        WHERE r.id_provider =" . $id_provider . " AND id_lang="
            . $id_lang . " AND ps.id_product_attribute = 0 LIMIT " . $limit . " OFFSET " . $offset;

        if (!$result = $db->executeS($sql)) {
            return false;
        }

        return $result;
    }


    public static function updateRelationByProduct($relaation_data, $id_product)
    {

        $sql = "UPDATE " . _DB_PREFIX_ . "autorestocking_relations
                SET min_count = " . $relaation_data['min_count'] . ",
                order_day =  " . $relaation_data['order_day'] . ",
                product_count = " . $relaation_data['product_count'] . "
                WHERE id_product = " . $id_product;

        if (!Db::getInstance()->execute($sql)) {
            return false;
        }

        return true;
    }

    public static function getAllCategoryByProviderId($id_provider)
    {

        $sql = 'SELECT id_category FROM ' . _DB_PREFIX_ . 'autorestocking_relations WHERE id_provider =' . $id_provider;
        $categories = Db::getInstance()->executeS($sql);
        $all_category = array();
        foreach ($categories as $categori) {
            $all_category[] = $categori['id_category'];
        }
        return $all_category;
    }

    public static function getAllProductByProviderId($smarty)
    {
        $limit = 10;
        $id_provider = Tools::getValue('id_provider');
        $page = (int)(Tools::getValue('page') ? Tools::getValue('page') : 1);
        $count_relation = Db::getInstance()->query(
            'SELECT * FROM ' . _DB_PREFIX_ . 'autorestocking_relations
             WHERE id_provider =' . $id_provider)->rowCount();
        if ($count_relation % $limit == 0) {
            $pages = $count_relation / $limit;
        } else {
            $pages = ceil($count_relation / $limit);
        }
        $offset = ($page == 1) ? 0 : $limit * ($page - 1);

        $relations = self::getByProviderId($id_provider, $offset, $limit);
        $smarty->assign(array(
            'relations' => $relations,
            'pages' => $pages,
            'select' => $page
        ));

        return $smarty->fetch(_PS_MODULE_DIR_ . 'autorestocking/views/templates/admin/view_relation.tpl');
    }


    public static function updateRelation()
    {
        $min_count = Tools::getValue('min_count');
        $type_order_day = Tools::getValue('type_order_day');
        $order_day = Tools::jsonEncode(Tools::getValue('order_day'));

        $product_count = Tools::getValue('product_count');
        $id_relations = Tools::getValue('id_relations');

        $sql = "UPDATE " . _DB_PREFIX_ . "autorestocking_relations
                SET min_count = " . $min_count . ",
                order_day =  '" . $order_day . "',
                product_count = " . $product_count . ",
                type_order_day = " . $type_order_day . "
                WHERE id_relations = " . $id_relations;
        if (!Db::getInstance()->execute($sql)) {
            return false;
        }
        return true;
    }


    public static function getAllRelation()
    {
        $sql = 'SELECT r.id_relations, r.id_product, r.id_provider, r.min_count,
        r.product_count, r.order_day, p.name, p.email FROM
        ' . _DB_PREFIX_ . 'autorestocking_relations r
        LEFT JOIN ' . _DB_PREFIX_ . 'providers p
        ON  r.id_provider = p.id_providers ';

        return Db::getInstance()->executeS($sql);
    }

    public static function getProductByCategoryId($id_category)
    {

        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $sql = 'SELECT p.id_product,p.id_category_default, pl.name FROM ' . _DB_PREFIX_ . 'product p
        LEFT JOIN ' . _DB_PREFIX_ . 'product_lang pl
        ON p.id_product=pl.id_product
        WHERE p.id_category_default=' . $id_category . ' AND pl.id_lang=' . $id_lang;
        return Db::getInstance()->executeS($sql);

    }

    public static function getProductsAllCategories()
    {
        $result = array();
        $categories = Tools::getValue('categories');
        foreach ($categories as $category) {
            $product = self::getProductByCategoryId($category);
            if (!empty($product)) {
                if (count($product) > 1) {
                    foreach ($product as $prod) {
                        $result[][0] = $prod;
                    }
                } else {

                    $result[] = $product;
                }

            }
        }
        return $result;
    }

    public static function saveRelationProductByProvider()
    {
        $products = Tools::getValue('products');
        $id_provider = (int)Tools::getValue('id_provider');
        $sql = $sql = 'SELECT id_product, id_product_attribute FROM
        ' . _DB_PREFIX_ . 'autorestocking_relations
        WHERE id_provider =' . $id_provider;
        $all_product = Db::getInstance()->executeS($sql);
        $check_product = array();
        $check_attribute = array();
        $check_delete = array();
        foreach ($all_product as $product) {
            $check_product[] = $product['id_product'];
            $check_attribute[] = $product['id_product_attribute'];
        }

        if (!empty($products)) {
            foreach ($products as $product) {
                if ($product['data_save'] == 1) {
                    $check_delete[] = isset($product['id_attribute']);
                    $id_attribute = isset($product['id_attribute']) ? $product['id_attribute'] : 0;
                    $name_combination = isset($product['name_combination']) ? $product['name_combination'] : '';
                    if ($id_attribute == 0) {
                        $attributes = self::getAttributeByIdProduct($product['id_product']);
                        if (!empty($attributes)) {
                            foreach ($attributes as $attribute) {
                                if (!in_array($attribute['id_product_attribute'], $check_attribute)) {
                                    self::insertRelationWithAttribute($product['id_product'], $product['id_category'],
                                        $product['id_provider'], $attribute['id_product_attribute'],
                                        $attribute['comb']);
                                }
                            }
                        } elseif (!in_array($product['id_product'], $check_product)) {
                            self::insertRelationWithAttribute($product['id_product'], $product['id_category'],
                                $product['id_provider'], $id_attribute, $name_combination
                            );
                        }
                    } elseif (!in_array($id_attribute, $check_attribute)) {
                        self::insertRelationWithAttribute($product['id_product'], $product['id_category'],
                            $product['id_provider'], $id_attribute, $name_combination
                        );
                    }
                }
                if ($product['data_save'] == 0 && $product['id_attribute'] != 0) {
                    $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'autorestocking_relations
                     WHERE id_product_attribute =' . $product['id_attribute'];

                    if (!Db::getInstance()->execute($sql)) {
                        return false;
                    }
                }

            }

        } else {
            return false;
        }
        return true;
    }

    public static function insertRelationWithAttribute($id_product, $id_category, $id_provider, $id_attribute, $name_combination)
    {
        $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'autorestocking_relations
                ( id_product, id_category, id_provider, id_product_attribute, name_combination)
                  VALUES(
                 ' . $id_product . ', ' . $id_category . ',
                 ' . $id_provider . ',' . $id_attribute . ',
                 "' . htmlspecialchars($name_combination) . '")';

        if (!Db::getInstance()->execute($sql)) {
            return false;
        }
        return true;
    }

    public static function getCategoryIdByProduct()
    {
        $id_product = Tools::getValue('id_product');
        $sql = $sql = 'SELECT id_category_default FROM
        ' . _DB_PREFIX_ . 'product
        WHERE id_product =' . $id_product;
        $id_category = Db::getInstance()->getRow($sql);

        return $id_category['id_category_default'];
    }

    public static function deleteRelationByIdRelation()
    {
        $id_relation = Tools::getValue('id_relation');

        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'autorestocking_relations
         WHERE id_relations =' . $id_relation;

        if (!Db::getInstance()->execute($sql)) {
            return false;
        }

        return true;
    }


    public static function getAttributeByIdProduct($id_product)
    {
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $sql = "SELECT p.id_category_default,p.id_product, a.id_product_attribute, ac.id_attribute,
        attr.id_attribute_group, GROUP_CONCAT(g.name,':',na.name) AS comb FROM
        " . _DB_PREFIX_ . "product p
        INNER JOIN " . _DB_PREFIX_ . "product_attribute a
        ON p.id_product = a.id_product
        INNER JOIN " . _DB_PREFIX_ . "product_attribute_combination ac
        ON a.id_product_attribute = ac.id_product_attribute
        INNER JOIN " . _DB_PREFIX_ . "attribute_lang na
        ON na.id_attribute = ac.id_attribute
        INNER JOIN " . _DB_PREFIX_ . "attribute attr
        ON attr.id_attribute = ac.id_attribute
        INNER JOIN " . _DB_PREFIX_ . "attribute_group_lang g
        ON g.id_attribute_group = attr.id_attribute_group
        WHERE p.id_product =" . $id_product . " AND na.id_lang =" . $id_lang . "
        AND g.id_lang =" . $id_lang . "
        GROUP BY a.id_product_attribute
		ORDER BY a.id_product_attribute";


        $results = Db::getInstance()->executeS($sql);

        return $results;
    }

    public static function getCombinationAndReelation($id_product)
    {
        $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $sql = "SELECT p.id_category_default, r.id_provider, r.id_relations, r.min_count,
        r.product_count, r.order_day, r.type_order_day, p.id_product, a.id_product_attribute, ac.id_attribute,
        attr.id_attribute_group, GROUP_CONCAT(g.name,':',na.name) AS comb FROM
        " . _DB_PREFIX_ . "product p
        LEFT JOIN " . _DB_PREFIX_ . "product_attribute a
        ON p.id_product = a.id_product
        LEFT JOIN " . _DB_PREFIX_ . "product_attribute_combination ac
        ON a.id_product_attribute = ac.id_product_attribute
        LEFT JOIN " . _DB_PREFIX_ . "autorestocking_relations r
        ON ac.id_product_attribute = r.id_product_attribute
        LEFT JOIN " . _DB_PREFIX_ . "attribute_lang na
        ON na.id_attribute = ac.id_attribute
        LEFT JOIN " . _DB_PREFIX_ . "attribute attr
        ON attr.id_attribute = ac.id_attribute
        LEFT JOIN " . _DB_PREFIX_ . "attribute_group_lang g
        ON g.id_attribute_group = attr.id_attribute_group
        WHERE p.id_product =" . $id_product . " AND na.id_lang =" . $id_lang . "
        AND g.id_lang =" . $id_lang . "
        GROUP BY a.id_product_attribute
		ORDER BY a.id_product_attribute";


        $results = Db::getInstance()->executeS($sql);

        return $results;
    }

    public static function saveRelationCombination()
    {
        $order_day = Tools::jsonEncode(Tools::getValue('order_day'));
        $id_relation = Tools::getValue('id_relation');


        if ($id_relation) {
            $sql = "UPDATE " . _DB_PREFIX_ . "autorestocking_relations
                SET min_count = " . Tools::getValue('min_count') . ",
                id_product = " . Tools::getValue('id_product') . ",
                id_provider = " . Tools::getValue('id_provider') . ",
                id_product_attribute = " . Tools::getValue('id_attribute') . ",
                name_combination = '" . htmlspecialchars(Tools::getValue('name_combination')) . "',
                id_category = " . Tools::getValue('id_category') . ",
                type_order_day = " . Tools::getValue('type_order_day') . ",
                order_day =  '" . Tools::jsonDecode($order_day) . "',
                product_count = " . Tools::getValue('product_count') . "
                WHERE id_relations = " . $id_relation;

            if (!Db::getInstance()->execute($sql)) {
                return false;
            }

            return true;
        } else {
            $sql = "INSERT INTO " . _DB_PREFIX_ . "autorestocking_relations
                ( id_product, id_category, id_provider, min_count,
                product_count ,type_order_day , order_day,
                id_product_attribute, name_combination)
                VALUES(" . Tools::getValue('id_product') . "," . Tools::getValue('id_category') . ",
                      " . Tools::getValue('id_provider') . "," . Tools::getValue('min_count') . ",
                       " . Tools::getValue('product_count') . ", ". Tools::getValue('type_order_day') .",'
                       " .  $order_day . "',
                      " . Tools::getValue('id_attribute') . ", '" . htmlspecialchars(Tools::getValue('name_combination')) . "')";

            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $id_insert = Db::getInstance()->Insert_ID();
            return $id_insert;
        }

    }
}

