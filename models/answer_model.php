<?php

class Answer_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getQuestion($id){
        return $this->db->select("
                select a.id quiz_id,a.title quiz_title,a.sub_title quiz_sub_title,b.title question_title,b.image question_image,c.title answer_title,c.points from quiz a ,question b,answer c 
                where a.id = b.quiz_id
                and   b.id = c.question_id
                and   b.id = :id
                and   a.quiz_type = 2
                order by c.id",array('id'=>$id));
    }
    public function getQuizQuestions($id){
        return $this->db->select("
                select a.id quiz_id,a.title quiz_title,a.sub_title quiz_sub_title,b.id question_id,b.title question_title,b.image question_image
                from quiz a ,question b
                where a.id = b.quiz_id
                and   a.id = :id
                order by b.id",array('id'=>$id));
    }     
    public function getmorequiz($id){
        return $this->db->select(
                " 
                (select id,title,username ,sub_title
                from quiz where status = 1 
                and division_id = 1 
                and id != :id
                order by create_date desc  limit 0,3)
                union
                (select id,title,username ,sub_title
                from quiz where status = 1 
                and division_id = 1 
                and star_flag = 1 
                and id != :id
                order by rand()  limit 0,3)",array('id'=>$id));
    }
  
}
?>
