<?php
$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'providers`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'sent_email`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'template_email`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'autorestocking_relations`;';


$query = 'DELETE FROM `'._DB_PREFIX_.'cronjobs`
                WHERE id_module ='.$this->id;
if (!Db::getInstance()->execute($query))
    return false;
