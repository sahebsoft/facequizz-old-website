<?php
class Index extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $u_rand = rand(0, 20);
        if($u_rand == 20) {
            $this->model->updateVisits();
        }
        if(isset($_REQUEST['ref'])){
            $ref = '&ref='.$_REQUEST['ref'];
            $this->view->ref = $ref;
        }
        $this->view->ad_slot = '9789613079';
        if($_REQUEST['ref'] =='ksa') {
            $this->view->ad_slot=  '4955456273';
        }
        
        $this->view->title = 'فيس كويز - اختبارات تحليل الشخصية - اختبارات الذكاء';
        $this->view->og_title = 'فيس كويز - اختبارات تحليل الشخصية - اختبارات الذكاء';
        
        $this->view->description = "اختبارات تحليل شخصية , اختبارات ذكاء , اختبارات للتسلية  , الغاز";
        $this->view->og_description = "اختبارات شخصية , اختبارات ذكاء , اختبارات للتسلية";
        $this->view->image = DOMAIN."facequizz.jpg";
	
        $this->view->quizzes = $this->model->lastquiz();
        $this->view->questions = $this->model->getQuizQuestions();
        
        $this->view->url = DOMAIN;
        $this->view->twitter_url = DOMAIN;
        
        $this->view->render('index/index');
    }
    
}