<?php
class Redirect extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index($id=0,$rid=0) {
        
        if(isset($_REQUEST['ref'])){
            $ref = '&ref='.$_REQUEST['ref'];
            $this->view->ref = $ref;
        }
        
        $this->model->trackVisit($id,$rid,9);
        if($id != 0){
            $this->view->url = quizLink(array('quiz_id'=>$id)).$ref;
        } 
        if ($rid != 0){
            //$this->view->url = quizLink(array('quiz_id'=>$id)).'&r='.$rid.'&sr=1'.$ref;
            $this->view->url = quizLink(array('quiz_id'=>$id)).'&r='.$rid.'&ref=fbshare';
            $this->view->share_url = "https://www.facebook.com/sharer.php?u=".urlencode(quizLink(array('quiz_id'=>$id)).'&r='.$rid.'&ref=fbshare');
        }

    $this->view->render('redirect/index',true);    
    }
}