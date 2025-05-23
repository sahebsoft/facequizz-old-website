<?php

class Index_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function lastquiz(){
        return $this->db->select("Select * from quiz where status = 1 and division_id = 1 order by visits desc  limit 0,20");
    }
    
    public function updateVisits(){        
        $this->db->query("update quiz a set visits = (SELECT count(*) FROM `visits`b  where a.id = b.quiz_id 
                            and   b.visit_date BETWEEN CURDATE() - INTERVAL 15 DAY AND CURDATE()
                            group by b.quiz_id)");
    }
    public function getQuizQuestions(){
        return $this->db->select("
                select a.id quiz_id,a.title quiz_title,a.sub_title quiz_sub_title,b.id question_id,b.title question_title,b.image question_image
                from quiz a ,question b
                where a.id = b.quiz_id
                and   a.quiz_type = 2
                order by rand() limit 0,10");
    }  
}
?>
