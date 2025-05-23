<?php
class Controller {

    function __construct() {
        $this->view = new View();
    }

    public function loadModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            
            $modelName = $name . '_Model';
            $this->model = new $modelName();
            
            //$this->model->trackVisit("0","test",10);
        }     


    }
    
    public function error() {
        header("HTTP/1.0 404 Not Found");
        require 'controllers/error.php';
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }  
    
    public function showIndex() {
        require 'controllers/index.php';
        $this->_controller = new Index();
        $this->_controller->index();
        exit;
    }      

}