<?php

require_once __DIR__.'/Abstract.php';

class FileReader_Xls extends FileReader_Abstract
{
    protected $phpExcelReader;

    public function __construct($file)
    {
        parent::__construct($file);
        $this->phpExcelReader = $this->setPHPExcelReader($file);
    }

    protected function setPHPExcelReader($file)
    {
        $objReader = new PHPExcel_Reader_Excel5();
        $objReader->setReadDataOnly(true);
        return $objReader->load($file);
    }
}
