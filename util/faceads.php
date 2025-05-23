<?php

require_once '/home/facequizz/www/config.php';
include 'urlshort.php';
manual_connect();
require_once("sdk/facebook.php"); // set the right path
$config = array();
$config['appId'] = '192178807633130';
$config['secret'] = '3115c2132def8b06ded7a3f9b9a3bbfc';
//$config['fileUpload'] = true;
$fb = new Facebook($config);

$arr = array(
    'fields' => 'description,message,message_tags,caption,actions,comments_mirroring_domain,coordinates,created_time,event,expanded_height,expanded_width,feed_targeting,full_picture,shares,sharedposts,sponsor_tags,from,timeline_visibility,likes,comments,icon,link'
  );
try {   
  $ret = $fb->api('/384141794277_10155744810099278', 'GET',$arr);
  
} catch(Exception $e) {
  echo $e->getMessage();
}


print_r($ret);
