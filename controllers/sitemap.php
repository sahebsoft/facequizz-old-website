<?php

class Sitemap extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
            header('Content-Type: text/xml; charset=utf-8');
            $this->view->cats = $this->model->getCats();
            $this->view->apps = $this->model->getApps();

            $this->view->render('sitemap/index',true);   
    }
    
}
?>