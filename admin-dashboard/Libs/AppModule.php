<?php
class AppModule{
    public function __construct() {
        //echo __CLASS__." __construct<br>";
        Database::$connection = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); 
    }
    public function getEmpMasterVO(){
        require_once 'Model/View/EmpMasterVO.php';
        return  new EmpMasterVO();
    }
}