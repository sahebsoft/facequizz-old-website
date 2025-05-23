<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api_model
 *
 * @author Ahmad
 */
class Api_Model  extends Model {
    public function __construct() {
        parent::__construct();
        $this->username  = Session::get("username");
        $this->user_type = Session::get("user_type");
    }
    public function getId($table){
        $query =  "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = '".$table."'";
        $result   = $this->db->select($query);
        return $result[0]['AUTO_INCREMENT'];
    }
    public function getQuizList(){        
        return $this->db->select("select id,title,status,create_date,username from quiz where (username = :username or 'a' = :user_type ) order by id desc",array(
            "username"=>$this->username,
            "user_type"=>$this->user_type));
    }
    public function createQuiz() {
        $id = $this->getId('quiz');
        $this->db->query("insert into quiz (id,title,username) values ($id,'Enter Quiz Title','".$this->username."')");
        $result = $this->db->select("select id from quiz where id = $id");
        if(count($result > 0)){
            $json = array('status'=>'success','id'=> $id);
        } else {
            $json = array('status'=>'error','msg'=> 'Error in creating quiz');
        }
        return $json;
    }
    public function setQuizData($id,$data){
        //print_r($data);
        
        $this->db->update('quiz',$data['info'],$id); 
        
        foreach($data['questions'] as $question) {
            if(!empty($question['action'])){                
                if(empty($question['id'])){                    
                    $question['id'] = $this->getId('question');
                }
                $question['quiz_id'] = $id;
                $this->db->{$question['action']}('question',$question,$question['id']); 
            }
            foreach($question['answers'] as $answer){
                if(!empty($answer['action'])) {
                    $answer['quiz_id'] = $id;
                    $answer['question_id'] = $question['id'];
                    $this->db->{$answer['action']}('answer',$answer,$answer['id']); 
                }
            }
        }
        
        foreach($data['results'] as $result){
            if(!empty($result['action'])) {
                $result['quiz_id'] = $id;
                $this->db->{$result['action']}('result',$result,$result['id']); 
            }
            //scores allways update
            foreach($result['scores'] as $score){
                if(!empty($score['action'])) {
                    $score_data = array("score_value"=>$score['score_value']);
                    $this->db->{$score['action']}('score',$score_data,$score['id']); 
                }
            }              
        }
        
        //scores allways update
        foreach($data['scores'] as $score){
            if(!empty($score['action'])) {
                $score['quiz_id'] = $id;
                $this->db->{$score['action']}('result',$score,$score['id']); 
            }
        }          
        echo json_encode($this->db->queries,JSON_NUMERIC_CHECK);
    }
    public function getQuizData($id){
        $quiz =  $this->db->select("select * from quiz where (username = :username or 'a' = :user_type ) and id = :id",array(
            "username"  =>  $this->username,
            "user_type" =>  $this->user_type,
            "id"        =>  $id )); 
        if(count($quiz) > 0 ){
            $questions  = $this->db->select ("select * from question where quiz_id = '$id'");
            $answers    = $this->db->select ("select * from answer   where quiz_id = '$id'");
            $results    = $this->db->select ("select * from result   where quiz_id = '$id'");
            $scores     = $this->db->select ("select a.*,b.title answer_title,c.id question_id,c.title question_title from score a,answer b ,question c   
                                            where a.answer_id = b.id
                                            and b.question_id = c.id
                                            and a.quiz_id = '$id' order by c.id,b.id");
            foreach($questions as $key=>$question){
                foreach($answers as $answer){
                    if($question['id'] == $answer['question_id']){
                        $questions[$key]['answers'][] = $answer;
                    }
                }
            }
            foreach($results as $key=>$result){
                foreach($scores as $score) {
                    if($result['id'] == $score['result_id']){
                        $results[$key]['scores'][] = $score;
                    }
                }
            }
            
            return array(
                'info'      => $quiz[0],
                'questions' => $questions,
                'results'   => $results,
            );            
        }

    }    
}
