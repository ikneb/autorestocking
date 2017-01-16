<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');


$description = 'http://test';
$task = 'http://test';
$hour = 1;
$day = 1;
$month = 1;
$day_of_week = 1;
$id_shop = 1;
$id_shop_group = 1;


$query = 'INSERT INTO '._DB_PREFIX_.'cronjobs
					(`description`, `task`, `hour`, `day`, `month`, `day_of_week`, `updated_at`, `active`, `id_shop`, `id_shop_group`)
					VALUES (\''.$description.'\', \''.$task.'\', \''.$hour.'\', \''.$day.'\', \''.$month.'\', \''.$day_of_week.'\', NULL, TRUE, '.$id_shop.', '.$id_shop_group.')';
echo Db::getInstance()->execute($query);