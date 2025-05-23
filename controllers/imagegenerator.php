<?php

class imagegenerator extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->view->render('imagegenerator/index',true);
    }
}
