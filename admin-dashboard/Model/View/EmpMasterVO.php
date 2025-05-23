<?php
require_once 'Model/Entity/EmpMasterEO.php';

class EmpMasterVO extends EmpMasterEO{   
    public static $query = "select id,trans_no from emp_master";   
    public static $order_by;
    
    /*
    public function setId($value) {
        parent::setId($value);
    }
    public function getId() {
        parent::getId();
    }
    public function setTransNo($value) {
        parent::setTransNo($value);
    }
    public function getTransNo() {
        parent::getTransNo();
    }    
    */
}