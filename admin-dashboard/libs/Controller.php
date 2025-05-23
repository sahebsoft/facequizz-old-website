<?php
class Controller {

    function __construct() {        
        //echo __CLASS__." __construct<br>";
        $this->view = new View();
        
    }
    
    public function index($page = 'index'){
        $this->view->render($page ."/index");
    }        
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }     
    }
    
    public static function error() {
        header("HTTP/1.0 404 Not Found");
        require CONTROLLER.'error.php';
        $error  = new Error();
        $error->index();
        exit;
    }  
    
    public static function showIndex() {
        require CONTROLLER.'index.php';
        $index = new Index();
        $index->index();
        exit;
    }      

}