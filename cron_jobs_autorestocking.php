<?php

require_once(dirname(__FILE__).'../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../init.php');
require_once(dirname(__FILE__).'/classes/Relation.php');
require_once(dirname(__FILE__).'/classes/Providers.php');
require_once(dirname(__FILE__).'/classes/EmailTemplate.php');
require_once(dirname(__FILE__).'/classes/Email.php');

$relations = Relation::getAllRelation();


foreach ($relations as $relation ) {
	if($relation['id_product'] != 0){
		$products_count = (int)Db::getInstance()->getValue('SELECT quantity FROM
 		'._DB_PREFIX_.'product WHERE id_product =' . $relation['id_product']  );

		if($relation['min_count'] >=  $products_count || $relation['min_count'] == date('w')){
			$message = EmailTemplate::generateMessage($relation['id_provider'], $relation['name'],$relation['id_product']);

			var_dump($message);
			$send = Email::sendEmail($relation['email'], $message);
			/*if($send){*/
				$email = new Email();
				$email->provider_name = $relation['name'];
				$email->email = $relation['email'];
				$email->send_date =  date("Y-m-d H:i:s");
				$email->save();
			/*}*/
		}
	}
}







