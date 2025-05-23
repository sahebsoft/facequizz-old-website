<?php

class Start_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getquiz($id){
        return $this->db->select("select * from quiz where id = :id",array('id'=>$id));
    }  
    public function getmorequiz($id){
        return $this->db->select("select * from quiz where id != :id and status = 1 and division_id = 1  order by id desc limit 0,1",array('id'=>$id));
    }
   
    public function trackVisit($quiz_id,$result_id,$type=0) {
        $arr = array('quiz_id' => $quiz_id,'result_id' => $result_id,'visit_type' => $type, 'ref' => $_SERVER["HTTP_REFERER"], 'ip' => getIp(),'agent'=>$_SERVER['HTTP_USER_AGENT']);
        $this->db->insert('visits', $arr); 
    }    
}
?>
