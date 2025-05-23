<?php

class View {

    function __construct() {
    $this->url = '';
    $this->image = '';
    $this->description = '';
    $this->title = '';
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {   
        if($noInclude){
            require 'views/' . $name . '.php';      
        } else{
            require 'views/header.php';    
            require 'views/' . $name . '.php';    
            require 'views/footer.php';  
        }
    }

}