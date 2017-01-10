<?php
/* Init */
$sql = array();
/* Create Table in Database */

$sql[] = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."providers` (
`id_providers` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(36) NOT NULL,
`email` varchar(36) NOT NULL,
`order_day` enum('0','1','2','3','4','5','6','7') NOT NULL DEFAULT '0',
PRIMARY KEY (`id_providers`)
)";


$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'sent_email` (
`id_sent_email` int(10) NOT NULL AUTO_INCREMENT,
`provider_name` varchar(50) NOT NULL,
`send_date` varchar(50) NOT NULL,
`email` varchar(255),
PRIMARY KEY (`id_sent_email`)
)';


$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'template_email` (
`id_template_email` int(10) NOT NULL AUTO_INCREMENT,
`template_email` varchar(255),
PRIMARY KEY (`id_template_email`)
)';
