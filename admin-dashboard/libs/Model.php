<?php
class Model{
    public function __construct() {
       $this->db =  Database::$connection = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS); 
    }
}