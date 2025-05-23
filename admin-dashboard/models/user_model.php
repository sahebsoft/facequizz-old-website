<?php
class User_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function userList()
    {
        return $this->db->select('SELECT username, title, user_type FROM user');
    }
    
    public function userSingleList($username)
    {
        return $this->db->select('SELECT username, title, user_type FROM user WHERE username = :username', array(':username' => $username));
    }
    
    public function create($data)
    {
        $this->db->insert('user', array(
            'username' => $data['username'],
            'password' => $data['password'],
            'title' => $data['title'],
            'user_type' => $data['user_type']
        ));
    }
    
    public function editSave($data)
    {
        $postData = array(
            'title' => $data['title'],
            'password' => $data['password'],
            'user_type' => $data['user_type']
        );
        
        $this->db->update('user', $postData, "`username` = {$data['username']}");
    }
    
    public function delete($username)
    {
        $result = $this->db->select('SELECT user_type FROM user WHERE username = :username', array(':username' => $username));
        if ($result[0]['user_type'] == 'a')
        return false;
        
        $this->db1->delete('user', "username = '$username'");
    }
}