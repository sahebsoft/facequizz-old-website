<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(1);
require './config.php';
require './util/Auth.php';
function __autoload($class) {
    require LIBS . $class .".php";
}


$bootstrap = new Bootstrap();
$bootstrap->init();