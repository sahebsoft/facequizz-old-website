<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $_controllerPath = CONTROLLER; // Always include trailing slash
    private $_modelPath = 'models/'; // Always include trailing slash
    private $_errorFile = 'error.php';
    private $_defaultFile = 'index.php';

    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    function __construct() {
    }
    function  init(){
        //echo __CLASS__." __construct<br>";
        // Sets the protected $_url
        $this->_getUrl();

        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->_loadExistingController();
        $this->_callControllerMethod();
        
    }

    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->loadModel('index');
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController() {
        $file = $this->_controllerPath . $this->_url[0] . '.php';

        if (file_exists($file)) {
            require $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel($this->_url[0], $this->_modelPath);
        } else {
            $this->_controller = new Controller();
        }
    }

    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod() {
        $length = count($this->_url);

        // Make sure the method we are calling exists
        if ($length > 2) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . URL);
            }
        }
        if ($length > 4) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . URL);
        }

        // Determine what to load
        switch ($length) {
            case 4:
                //Controller->Method(Param1, Param2)
                if ($this->_url[2] == 'page')
                    $this->_controller->index($this->_url[1], $this->_url[3]);
                else
                    $this->_controller->{$this->_url[2]}($this->_url[1], $this->_url[3]);
                break;

            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                //$this->_controller->index($this->_url[1], $this->_url[2]); 
                break;

            case 2: 
                //Controller->Method(Param1)
                $this->_controller->{$this->_url[1]}();
                break;

            default:
                $this->_controller->index($this->_url[0]);
                break;
        }
    }

    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = new Error();
        $this->_controller->index();
        exit;
    }

}
