<?php

class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);   
    }

    public function trackRef($quiz_id,$result_id,$type=0) {
        $arr = array('quiz_id' => $quiz_id,'result_id' => $result_id,'visit_type' => $type, 'ref' => $_SERVER["HTTP_REFERER"], 'ip' => getIp(),'agent'=>$_SERVER['HTTP_USER_AGENT']);
        $this->db->insert('visits', $arr); 
    }       
    public function trackVisit($quiz_id,$result_id,$type=0) {
        $arr = array('quiz_id' => $quiz_id,'result_id' => $result_id,'visit_type' => $type, 'ref' => $_SERVER["REQUEST_URI"], 'ip' => getIp(),'agent'=>$_SERVER['HTTP_USER_AGENT']);
        $this->db->insert('visits', $arr); 
    }    
    
}