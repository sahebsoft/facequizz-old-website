<?php

class Privacy extends Controller {

    public function __construct() {
        parent::__construct();
        //Auth::handleLogin();
    }
    
    public function index() 
    {    
        
        if(isset($_GET['ref'])){
            $ref = '&ref='.$_GET['ref'];
            $this->view->ref = $ref;
        }        
        $this->view->title = 'Privacy Policy';        
        $this->view->render('privacy/index');
    }
 
}