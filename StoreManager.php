<?php

header("Content-Type: text/html; charset=UTF-8");  
require_once __DIR__.'/FileReader/Xlsx.php';
require_once __DIR__.'/FileReader/Xls.php';

class StoreManager
{
	protected $fileReader;

	protected static $fileReaderMapper = array(
		'xlsx' => 'FileReader_Xlsx',
		'xls' => 'FileReader_Xls',
	);

	protected $databaseStores = array();

	private  function __construct() { }

	public static function loadStoresFromFileAndDatabaseStoreInArray($file, array $databaseStores)
	{
		$fileExtension = pathinfo($file, PATHINFO_EXTENSION);
		// Validate file extension
		if (!array_key_exists($fileExtension, self::$fileReaderMapper)) {
			throw new Exception('Invalid file, file extension must be of type "'.implode(', ', array_keys(self::$fileReaderMapper)).'"');
		}
		// Validate if file exist
		if (!file_exists($file)) {
			throw new Exception('File does not exist at path "'.$file.'"');
		}
		$class = new self;
		$fileReaderClass = self::$fileReaderMapper[$fileExtension];
		$class->fileReader = new $fileReaderClass($file);
		$class->databaseStores = $databaseStores;
		return $class;
	}

	protected function getFileReader()
	{
		return $this->fileReader;
	}

	protected function getDatabaseStores()
	{
		return $this->databaseStores();
	}

	public function fetchValidStores()
	{
		
	}

	public function fetchInvalidStores()
	{
		
	}

	public function fetchAllStores()
	{
		return $this->getFileReader()->toArray();
	}

	public function hasInvalidStores()
	{
		
	}
}

