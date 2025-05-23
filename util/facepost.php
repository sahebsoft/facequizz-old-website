<?php
die;
//https://graph.facebook.com/oauth/access_token?client_id=192178807633130&client_secret=2939506e5b5e19268f82e8a28212583c&grant_type=fb_exchange_token&fb_exchange_token=CAACuyR2P9OoBABzaFRqRr3fd7AdfibcvFspnpDmxAuyLSiewRHrMMPZAPAJrEVKhsgYoqgKuL99u4IcEMdrNaYQh8G3NZCgxPL5qh1ojTL5SasW1RUGYZAIssuv9yF5a8QuxNLA8J6ICKoEa4kPLikH9wCDN0uSxF49Suyf8l9cikH0WDxjW0HCWW2RV0MZD
require_once '/home/facequizz/www/config.php';
require_once '/home/facequizz/www/libs/Database.php';
include 'urlshort.php';
require_once("sdk/facebook.php"); // set the right path

$db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
$config = array();
$config['appId'] = '192178807633130';
$config['secret'] = '3115c2132def8b06ded7a3f9b9a3bbfc';
//$config['fileUpload'] = true;
$fb = new Facebook($config);
$and = '';
 if(isset($_GET['id'])) {
     $and =' and quiz.id = '.$_GET['id'];
 }
 if(isset($_GET['m']) && $_GET['m'] == 'r')
 {
     $sql = $db->select("select quiz.id,quiz.title,quiz.sub_title,quiz.image,result.title result_title,result.sub_title result_sub_title,result.image result_image from quiz,result where quiz.status = 1 and quiz_type = 1  and division_id = 1 $and  and quiz.id =  result.quiz_id order by publish_date  limit 0,1");
 } else  $sql = $db->select("select id,title,sub_title,image from quiz where status = 1 and division_id = 1  $and order by publish_date  limit 0,1");
//echo "select id,title,sub_title,image from quiz where status = 1 and division_id = 1  $and order by publish_date  limit 2,1"; 
$App = $sql[0];
 $source = '../image/'.$App['image'];
 $id = $App['id'];
 if($App['id'] == '' ) die;
 $link  = 'http://www.facequizz.com/?id='.$App['id']; 
 $response = shortenUrl($link);
 
 
 $desc = $App['title'].' 
هذا الاختبار يتكون من عدة أسئلة , جاوب عليها لتعرف نتيجتك.';
 $image  = $App['image'];
if(isset($_GET['m']) && $_GET['m'] == 'r')	{
    $link  = 'http://www.facequizz.com/?id='.$App['id'].'&r='.$App['result_id']; 
    $desc 	= $App['title'] .'
        نتيجتي كانت : '.' '.$App['result_title'].' 
        
        لتعرف نتيجتك ابدأ الاختبار و جاوب على جميع الاسئلة :)';
$image = $App['result_image'];
}

 echo $desc."<br>".$link; 
   
$params = array(
  // this is the access token for Fan Page
  "access_token" => "EAACuyR2P9OoBAI9D9thIQOn4v88pSiSP46GZAVzKC25NjW5crnAgp1h9ZBekcZBcFgDQdKU7GPKQjmrqVnv2YK6ZCdBzplZBliVaEHyWDYEsmbaXcVjKTFNz4cyxJb9GAH34dgWfCyaIoVLlUeKMqehWhEFv68Y9VGZCKpffTYf3R37ls0F0uZACWq5PQB8mTEZD",
  "message" => "$desc",
    "link" => $link,
    "picture" => DOMAIN."image/".$image,
  //"source" => "@" . "$source",
  // "timeline_visibility" => "starred", // ATTENTION give the PATH not URL
);
 
try {
    echo "update quiz set publish_date = now() where id = '$id'";
    $stmt  = $db->prepare("update quiz set publish_date = now() where id = '$id'");
    $stmt->execute();
  // 466400200079875 is Facebook id of Fan page https://www.facebook.com/pontikis.net
  $ret = $fb->api('/1767490803475523/feed', 'POST', $params);
  
} catch(Exception $e) {
  echo $e->getMessage();
}
?>