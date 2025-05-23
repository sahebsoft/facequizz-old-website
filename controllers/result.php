<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of result
 *
 * @author Ahmad
 */
class result  extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $POST = json_decode(file_get_contents("php://input"),true); 
        $POST = json_decode('{ "quiz_id": 42, "answers": { "377": "1294", "378": "1297", "379": "1302", "380":  "1305"}}',true);
        echo "<pre>";
        $keys=  array_values($POST['answers']);
        $query=join(",",$keys);
        echo $query;
        //print_r($data);die;
        
        echo json_encode($POST);
    }
}
