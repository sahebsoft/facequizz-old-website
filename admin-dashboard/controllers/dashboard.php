<?php
class Dashboard extends Controller{
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    public function index($id = null){
        $this->view->render('index/index');
    }    
}


