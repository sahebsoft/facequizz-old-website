<?php

class IdTest_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getquiz($id){
        return $this->db->select("
    select if(random_flag = 1 ,rand(),1) ran,score_flag,user.ad_slot,quiz.id quiz_id,quiz.quiz_type,quiz.status quiz_status,quiz.title quiz_title,quiz.sub_title quiz_sub_title,quiz.image quiz_image,question.id question_id,question.youtube_code question_youtube_code,question.title question_title,question.image question_image
    ,(select max(point_to) from  result where quiz_id = :id) max_point    
    from quiz,question,user
    where quiz.id = :id
    and   question.quiz_id = quiz.id
    and   quiz.username = user.username
    order by 1,question.id",array('id'=>$id));
    }  
    public function getAnswers($id){
        return $this->db->select("select answer.id answer_id,answer.title answer_title,answer.question_id  from answer where quiz_id = :id",array('id'=>$id));
    }
    public function getmorequiz($id,$text){
        return $this->db->select(
                " 
                (select id,title,username ,sub_title
                from quiz where status = 1 
                and MATCH (title) AGAINST (:text)
                and division_id = 1 
                and id != :id 
                limit 0,8)
                union
                (select id,title,username ,sub_title
                from quiz where status = 1 
                and division_id = 1 
                and id != :id
                order by create_date desc  limit 0,3)",array('id'=>$id,'text'=>$text));
    }
    public function getresult($query,$type){
        if($type == 1){
            return $this->db->select("select score.result_id,sum(score_value),result.title,result.sub_title ,result.id 
            from answer,score,result
            where answer.id IN ($query) 
            and score.answer_id = answer.id
            and result.id = score.result_id
            group by score.result_id
            order by 2 desc limit 0,1");
        } 
        if($type == 2 || $type == 3){
            return $this->db->select("select  result.id,result.point_from,result.point_to,sum(points) score
            from  answer,question,result 
            where answer.id IN ($query)  
            and   answer.question_id =question.id
            and   result.quiz_id = question.quiz_id
            group by result.id
            having sum(points) between point_from and point_to
            limit 0,1");
        }
    }
    
 public function getresultbyid($id,$quiz_id){
        return $this->db->select("select id,title,sub_title,image from  result where id = :id and quiz_id = :quiz_id",array('id'=>$id,'quiz_id'=>$quiz_id));
    }
    
    public function trackVisit($quiz_id,$result_id,$type=0) {
        $arr = array('quiz_id' => $quiz_id,'result_id' => $result_id,'visit_type' => $type, 'ref' => $_SERVER["REQUEST_URI"], 'ip' => getIp(),'agent'=>$_SERVER['HTTP_USER_AGENT']);
        $this->db->insert('visits', $arr); 
    }    
}
?>
