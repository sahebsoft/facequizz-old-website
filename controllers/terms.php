<?php

class Terms extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() 
    {    
        $this->view->title = 'Terms Of Use';
        $this->view->render('terms/index');
    }
    

}