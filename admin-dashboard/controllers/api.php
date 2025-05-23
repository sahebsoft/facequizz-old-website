<?php

class api extends Controller {
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        header('Content-Type: application/json; charset=utf-8');
        $this->view->user_type = Session::get("user_type");
    }
    public function index(){
        
    }
    
    public function quiz_list(){
        $res  = $this->model->getQuizList();
        echo json_encode($res, JSON_NUMERIC_CHECK);
    }
    
    public function get_quiz($id){
        $res  = $this->model->getQuizData($id);
        echo json_encode($res, JSON_NUMERIC_CHECK);
    }
    public function create_quiz(){        
        $res = $this->model->createQuiz();  
        echo json_encode($res, JSON_NUMERIC_CHECK);
    }
    public function save_quiz($id){
        $data = json_decode(file_get_contents("php://input"),true); 
        $info = file_get_contents("php://input");
        //$info = '{ "info": { "id": 529, "title": "Enter Quiz Title", "image": null, "username": "ahmadsaheb", "division_id": 1, "quiz_type": 1, "create_date": "2016-11-25 13:55:57", "status": 2, "sub_title": "asdasd", "random_flag": 1, "adsense_flag": 0, "star_flag": 0, "publish_date": "0000-00-00 00:00:00", "score_flag": 1, "fb_flag": 0 }, "questions": [ { "quiz_id": 0, "action": "insert", "answers": [ { "quiz_id": 0, "action": "insert", "title": "answer1" }, { "quiz_id": 0, "action": "insert", "title": "answer 2" }, { "quiz_id": 529, "action": "insert", "title": "answer 3" } ], "title": "question1", "image": "image", "youtube_code": "youtube" } ], "results": [ { "quiz_id": 529, "action": "insert", "title": "res 1", "sub_title": "res 1 desc" } ] }';
        $this->model->setQuizData($id,json_decode($info,true));        
    }    
}
