<?php

class Dashboard_Model extends Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function result($is_master){
        if($is_master) $con = 'person_id = 1';
        else $con= 'person_id != 1';
        return $this->db->select("select a.question_name,a.question_value,a.person_id from answer a where ".$con);
    }
    
    
}
