<?php

abstract class FileReader_Abstract
{
	protected $skipRowsFromTop = 1;

	protected $columns = array(
		'store_name' => 'NOM DE LA BOUTIQUE',
		'domain' => 'DOMAINE/SOUS-DOMAINE DE LA BOUTIQUE',
		'store_type' => 'TYPE DE BOUTIQUE',
		'description_fr' => 'DESCRIPTION DE LA BOUTIQUE (FR)',
		'description_en' => 'DESCRIPTION DE LA BOUTIQUE (EN)',
		'store_default' => 'DEFAULT STORE',
		'enabled' => 'ENABLED',
		'telephone' => '',
		'email' => 'COURRIEL',
		'first_name' => 'FIRST NAME',
		'last_name' => 'LAST NAME'
	);

	public function __construct($file)
	{
		$this->file = $file;
	}

	protected function getPHPExcelReader()
	{
		return $this->phpExcelReader;

	}

	public function toArray()
	{
		$stores = array();
		foreach ($this->getPHPExcelReader()->getWorksheetIterator() as $worksheet) {
    		$stores = $worksheet->toArray();

		}

		// Skip rows from top
		$stores = $this->skipRowsFromTop($stores, $this->skipRowsFromTop);

		// Purge empty rows
		$stores = $this->purgeEmptyRows($stores);
		return $stores;
	}

	public function purgeEmptyRows(array $stores)
	{
		$result = array();
		foreach($stores as $store) {
			// If all columns are not empty
			if (array_filter($store)) {
				$result[$store[2]][] = $store;
			}
		}
		return $result;
	}

	protected function skipRowsFromTop($index, $rows)
	{
		return array_slice($index, $rows);
	}
}
