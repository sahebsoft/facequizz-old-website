<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($alias) {
        
        if(isset($_GET['ref'])){
            $ref = '&ref='.$_GET['ref'];
            $this->view->ref = $ref;
        }        
        if ($alias == 'contact') {
            if ($_POST['submit']) {
                $this->view->name = $_POST['name'];
                $this->view->subject = $_POST['subject'];
                $this->view->email = $_POST['address'];
                $this->view->message = $_POST['message'];
                if ($_POST['name'] != '' && $_POST['subject'] != '' && $_POST['address'] != '' && $_POST['message'] != '') {

                    $this->view->success = 'You message has been sent successfully , thanks for contacting us.';
                    $data = array(
                        'name' => $_POST['name'],
                        'subject' => $_POST['subject'],
                        'email' => $_POST['address'],
                        'message' => $_POST['message']
                    );
                    $this->model->create($data);
                } else {
                    $this->view->error = 'please fill all required fields!';
                }
            }
            $this->view->title = 'Contact Us';
            $this->view->render('home/contact');
        }
        if ($alias == 'terms') {
            $this->view->title = 'Terms Of Use';
            $this->view->render('home/terms');
        }
        if ($alias == 'privacy') {
            $this->view->title = 'Privacy Policy';
            $this->view->render('home/privacy');
        }
        if ($alias == 'sitemap') {
            
            header('Content-Type: text/xml; charset=utf-8');
            $this->view->question = $this->model->getQuestion();
            $this->view->quiz = $this->model->getQuiz();
            
            $this->view->render('home/sitemap', true);
            
        }
    }

}
