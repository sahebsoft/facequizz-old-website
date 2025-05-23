<?php
class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function run()
    {   
        $data = $this->db->select("SELECT username, user_type FROM user WHERE 
                username = :username AND password = :password",array(':username' => $_POST['username'],':password' => $_POST['password']));
        /*$sth->execute(array(
            ':username' => $_POST['username'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));*/

        if (count($data) > 0) {
            
            Session::init();
            Session::set('user_type', $data[0]['user_type']);            
            Session::set('username', $data[0]['username']);
            Session::set('title', $data[0]['title']);
            Session::set('loggedIn', true);
            header('location: '.URL);
        } else {         
            header('location: '.URL.'login');            
        }

        
    }
    
}