<?php
/* Init */
$sql = array();
/* Create Table in Database */

$sql[] = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "providers` (
`id_providers` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(36) NOT NULL,
`description` varchar(255) NOT NULL,
`email` varchar(36) NOT NULL,
`token` varchar(36) NOT NULL,
PRIMARY KEY (`id_providers`)
)";


$sql[] = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "autorestocking_relations` (
`id_relations` int(11) NOT NULL AUTO_INCREMENT,
`id_product` int(11) NOT NULL,
`id_category` int(11) NOT NULL,
`id_provider` int(11) NOT NULL,
`id_product_attribute` int(11) NOT NULL,
`name_combination` varchar(100) NOT NULL,
`min_count` int(11) NOT NULL,
`product_count` int(11) NOT NULL,
`type_order_day` int(11) NOT NULL,
`order_day` varchar(100) NOT NULL,
`status` int(11) NOT NULL,
PRIMARY KEY (`id_relations`))
";


$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'sent_email` (
`id_sent_email` int(10) NOT NULL AUTO_INCREMENT,
`provider_name` varchar(50) NOT NULL,
`send_date` varchar(50) NOT NULL,
`email` varchar(255),
`token` varchar(255),
`id_order` int(10),
`id_state` int(10),
PRIMARY KEY (`id_sent_email`)
)';


$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'template_email` (
`id_template_email` int(11) NOT NULL AUTO_INCREMENT,
`template_email` varchar(255),
PRIMARY KEY (`id_template_email`)
)';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'setting_autorestocking` (
`id_setting` int(11) NOT NULL AUTO_INCREMENT,
`name_setting` varchar(255),
`value_setting` int(11),
PRIMARY KEY (`id_setting`)
)';

