<?php
class Start extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index($id) {
        $quiz = $this->model->getquiz($id);
        $this->view->morequiz = $this->model->getmorequiz($id);

        
        $this->view->title = $quiz[0]['title'];
        $this->view->status = $quiz[0]['status'];
        $this->view->og_title = $quiz[0]['title'];
        $this->view->description = $quiz[0]['sub_title'];
        $this->view->og_description = $quiz[0]['sub_title'];
        $this->view->quiz_id= $quiz[0]['id'];
        $this->view->ad_slot= $quiz[0]['ad_slot'];
        $this->view->image = IMAGE_PATH.$quiz[0]['image'];
        $this->view->url = quizLink(array('quiz_id'=>$quiz[0]['id']));
       
       
        $this->view->quiz = $quiz;
        
        
        $this->view->render('start/index');    
        
            }

    
}

