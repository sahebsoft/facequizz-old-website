<?php
class User extends Controller {
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    
    public function index() 
    {    
        $this->view->userList = $this->model->userList();
        $this->view->render('user/index');
    }
    public function logout() {
        Session::destroy();
        header('location: ' . URL . 'login');
    }
    public function create() 
    {
        $data = array();
        $data['title'] = $_POST['title'];
        $data['password'] = $_POST['password'];
        $data['user_type'] = $_POST['user_type'];
        
        // @TODO: Do your error checking!
        
        $this->model->create($data);
        header('location: ' . URL . 'user');
    }
    
    public function edit($id) 
    {
        $this->view->user = $this->model->userSingleList($id);
        $this->view->render('user/edit');
    }
    
    public function editSave($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['title'] = $_POST['title'];
        $data['password'] = $_POST['password'];
        $data['user_type'] = $_POST['user_type'];
        
        // @TODO: Do your error checking!
        
        $this->model->editSave($data);
        header('location: ' . URL . 'user');
    }
    
    public function delete($id)
    {
        $this->model->delete($id);
        header('location: ' . URL . 'user');
    }
}