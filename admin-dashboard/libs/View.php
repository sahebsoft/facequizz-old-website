<?php

class View {
    private $_viewPath = 'views/';
    public $_title;
    public $_description;
    
    function __construct() {
        //echo __CLASS__ . " __construct<br>";
    }

    public function render($name, $noInclude = false) {
        if (file_exists($this->_viewPath . $name . '.php')) {
            if ($noInclude) {
                require $this->_viewPath . $name . '.php';
            } else {
                require $this->_viewPath . 'header.php';
                require $this->_viewPath . $name . '.php';
                require $this->_viewPath . 'footer.php';
            }
        } else {
            header("HTTP/1.0 404 Not Found");
            $this->_title = "Page Not Found";
            require $this->_viewPath . 'header.php';
            require $this->_viewPath . 'error.php';
            require $this->_viewPath . 'header.php';
        }
    }
    

}
