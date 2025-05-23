<?php

class Home_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    
    public function create($data)
    {
        $this->db->insert('contact', array(
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message']
        ));
    }
    
    public function getQuestion(){
        return $this->db->select("
            select a.id quiz_id,a.create_date,a.title quiz_title,a.sub_title quiz_sub_title,b.id question_id,b.title question_title,b.image question_image
            from quiz a ,question b
            where a.id = b.quiz_id
            and   a.quiz_type = 2
            order by b.id desc");
    }     
    
    public function getQuiz(){
        return $this->db->select("Select id,create_date from quiz where status = 1 and division_id = 1 order by create_date desc  ");
    }    
}