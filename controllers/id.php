<?php
class Id extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index($id) {
        if(isset($_REQUEST['ref'])){
            $ref = '&ref='.$_REQUEST['ref'];
            setcookie('ref', $_REQUEST['ref'], time()+3600, "/", "facequizz.com");
            $this->view->ref = $ref;
        }
        //$this->model->trackRef($id,$_GET['r'],10); 
        
        $quiz = $this->model->getquiz($id);
        $this->view->morequiz = $this->model->getmorequiz($id);
        $this->view->title = $quiz[0]['quiz_title'].' - فيس كويز';
        $this->view->quiz_title = $quiz[0]['quiz_title'];
        $this->view->status = $quiz[0]['quiz_status'];
        $this->view->og_title = $quiz[0]['quiz_title'];
        $this->view->description = $quiz[0]['quiz_sub_title'];
        $this->view->og_description = $quiz[0]['quiz_sub_title'];
        $this->view->quiz_id= $quiz[0]['quiz_id'];
        $this->view->ad_slot= $quiz[0]['ad_slot'];
        $this->view->score_flag= $quiz[0]['score_flag'];
        $this->view->max_point= $quiz[0]['max_point'];
        if($_REQUEST['ref'] == 'ksa') {
           $this->view->ad_slot=  '4955456273';
        }
        $this->view->image =  isset($quiz[0]['quiz_image']) ? IMAGE_PATH.$quiz[0]['quiz_image'] : null;
        $this->view->quiz_image = IMAGE_PATH.$quiz[0]['quiz_image'];

        $this->view->url = quizLink(array('quiz_id'=>$quiz[0]['quiz_id'])).$ref;
        $this->view->quiz_url = quizLink(array('quiz_id'=>$quiz[0]['quiz_id']));
        $this->view->twitter_url = DOMAIN.'t/'.$quiz[0]['quiz_id'];
        $this->view->twitter_quiz_url = DOMAIN.'t/'.$quiz[0]['quiz_id'];
        
        $this->view->showresult = 0;
        
        
        //if($id == '40'){
        //$this->model->trackVisit($quiz[0]['quiz_id'],0,1);
        //}
        
        if(!empty($_POST)){
        $keys=  array_values($_POST);
        $query=join(",",$keys);
        $resultget = $this->model->getresult($query,$quiz[0]['quiz_type']);
        $this->view->score = $resultget[0]['score'];
        //$this->model->trackVisit($quiz[0]['quiz_id'],$result[0]['id'],1); 
        $result_desc =  $resultget[0]['score'].' من '.$quiz[0]['max_point'];
        
        setcookie('resultdesc_'.$quiz[0]['quiz_id'], $result_desc, time()+600, "/", "facequizz.com");      
        header('Location: '.quizLink(array('quiz_id'=>$quiz[0]['quiz_id'])).'&r='.$resultget[0]['id'].'&sr=1'.$ref);
        //exit();
        //echo "server error ".$query;die;
        }
        if(!empty($_POST) || $_GET['r']!= ''){
        $res_id = isset($resultget[0]['id'])  ? $resultget[0]['id'] : $_GET['r'];
        $result = $this->model->getresultbyid($res_id,$quiz[0]['quiz_id']);
        
        $this->view->result = $result;
        $this->view->result_id = $result[0]['id'];
        $this->view->og_title = $quiz[0]['quiz_title']. ' - '.$result[0]['title'];
        $this->view->title = $result[0]['title'];
        $this->view->og_description = $quiz[0]['quiz_sub_title'];
        $this->view->image = IMAGE_PATH.$result[0]['image'];
        $this->view->url = quizLink(array('quiz_id'=>$quiz[0]['quiz_id'])).'&r='.$result[0]['id'].$ref;
        $this->view->twitter_url = DOMAIN.'t/'.$quiz[0]['quiz_id'].'&r='.$result[0]['id'];
        if(!empty($_POST) || $_GET['sr'] == '1'){
            $rid = $_GET['r'];
        $this->view->share_url = "https://www.facebook.com/sharer.php?u=".urlencode(quizLink(array('quiz_id'=>$id)).'&r='.$rid.'&ref=fbshare');
        $this->view->render('id/result');  
        exit();
        }
        }
        
        
        foreach($quiz as $question){
        $quiz_arr[$question['question_id']] = array('question_title'=> $question['question_title'],'question_image'=> $question['question_image'],'question_youtube_code' =>$question['question_youtube_code']);
        foreach ($quiz as $answer){
            if($question['question_id'] == $answer['question_id']){
                $quiz_arr[$question['question_id']]['answer'][$answer['answer_id']] = array('answer_title' => $answer['answer_title']);    
            }
        }
           
        }
        $this->view->quiz = $quiz_arr;
        
        //if($_GET['ref'] == '' && $_GET['sr'] != 1 ){
        //if(!isset($_COOKIE['visit'])){
        //setcookie('visit', 1, time()+172800, "/", "facequizz.com");
        //}
        //}
        
//        if($_GET['s'] != '1' && $_GET['sr'] != '1' ){
//            $this->view->render('id/start');  
//            setcookie('visit', 1, time()+172800, "/", "facequizz.com");
//            exit;
//        }   
        
        if($_GET['s'] == '1'){      
            $this->view->render('id/index');    
            exit;
        }        
        
        if($_GET['r'] != '' && $_GET['sr'] == '1'){
            $rid = $_GET['r'];
            
            $this->view->render('id/result');  
           exit;
        }   
        
        $this->view->render('id/start');   
    }
}