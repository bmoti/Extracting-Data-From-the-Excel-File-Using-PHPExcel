<?php
ini_set('display_errors', 1);
require 'StoreManager.php';
require_once __DIR__.'/vendor/phpexcel/PHPExcel.php';
require_once __DIR__.'/vendor/phpexcel/PHPExcel/IOFactory.php';


$databaseStores = array(
	'name' => '',
	'domain' => '',
	'store_type' => '',
	'store_default' => '',
	'description_fr' => '',
	'description_en' => '',
	'enabled' => '',
	'telephone' => '',
	'email' => '',
	'first_name' => '',
	'last_name' => ''
);
$storeManager = StoreManager::loadStoresFromFileAndDatabaseStoreInArray('storelist.xls', $databaseStores);

echo '<pre>';
print_r($storeManager->fetchAllStores());
die;