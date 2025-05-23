<?php
class upload  extends Controller{
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index(){
        if(isset($_FILES['file'])){
            $errors= array(); 
            $upload_path = "/home/facequizz/www/image/";
            $file_name = $_FILES['file']['name'];
            $file_size =$_FILES['file']['size'];
            $file_tmp =$_FILES['file']['tmp_name'];
            $file_type=$_FILES['file']['type'];   
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $extensions = array("jpeg","jpg","png");
            $upload_name = uniqid().".".$file_ext;
            if(in_array($file_ext,$extensions )=== false){
                $errors[]="image extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size > 2097152){
                $errors[]='File size cannot exceed 2 MB';
            }               
            if(empty($errors)==true){
                move_uploaded_file($_FILES['file']['tmp_name'],$upload_path.$upload_name);
                echo json_encode(array("image_name"=>$upload_name));
            }else{
                echo json_encode($errors);
            }
        }        
    }
}
