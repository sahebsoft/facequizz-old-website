<?php
class EmpMasterEO extends Entity{

    public static $ID;
    public static $TRANSNO;
    public static $TRANSDATE;
    
    public function __construct() {
        EmpMasterEO::$DBObjectType="table";
        EmpMasterEO::$DBObjectName="emp_master";
        EmpMasterEO::$DBObjectClass="EmpMasterVO";
        EmpMasterEO::$ID        = new Attribute('Id',0,'Id',"id","trans_master","int(11)");
        EmpMasterEO::$TRANSNO   = new Attribute('TransNo',1,'Trans No',"trans_no","trans_master","int(11)");
        EmpMasterEO::$TRANSDATE = new Attribute('TransDate',1,'Trans Date',"trans_date","trans_master","date");
        parent::__construct();
    }
    public function setId($value) {
        $name = EmpMasterEO::$ID->Name;
        $this->$name = $value;
    }
    public function getId() {
        $name = EmpMasterEO::$ID->Name;
        return $this->$name ;
    }
    public function setTransNo($value) {
        $name = EmpMasterEO::$TRANSNO->Name;
        $this->$name = $value;
    }
    public function getTransNo() {
        return EmpMasterEO::$TRANSNO;
    }    

}
