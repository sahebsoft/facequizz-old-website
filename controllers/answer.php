<?php
class Answer extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index($id) {
        if($quiz = $this->model->getQuestion($id)){
        $this->id = $id;
        $this->view->quiz = $quiz;
        $this->view->questions = $this->model->getQuizQuestions($quiz[0]['quiz_id']);
        
        $this->view->title = $quiz[0]['question_title'];
        $this->view->quiz_title = $quiz[0]['quiz_title'];
        $this->view->og_title = $quiz[0]['question_title'];
        $this->view->description = 'اجابة السؤال - '.$quiz[0]['question_title'];
        $this->view->og_description = 'اجابة السؤال - '.$quiz[0]['question_title'];
        $this->view->quiz_id= $quiz[0]['quiz_id'];
        $this->view->question_image = $quiz[0]['question_image'];
         
        $this->view->render('answer/index');   
        } else {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".URL);
        }
    }
}

