<?php
$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'providers`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'sent_email`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'template_email`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'autorestocking_relations`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'setting_autorestocking`;';
