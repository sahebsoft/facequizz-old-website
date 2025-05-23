<?php
error_reporting(0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
setcookie('visit', 1, time()+86400, "/", "facequizz.com");
header('Content-Type: text/html; charset=utf-8');

define('URL', 'https://www.facequizz.com/');
define('DOMAIN', 'https://www.facequizz.com/');
define('SHORT_DOMAIN', 'https://facequizz.com/');
//define('IMAGE_PATH','http://image.facequizz.com/android_images/');
//define('IMAGE_PATH','http://www.facequizz.com/android/public/android_images/');
define('IMAGE_PATH','https://www.facequizz.com/image/');
define('LIBS', 'libs/'); 
define('DB_APP_FILTER', 'review_flag = 1');
  
  
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'facequiz_db');
define('DB_USER', 'facequizz_admin'); 
define('DB_PASS', '62a5d&5^4ZJgBvPFQmW');
define('XP',"facebookquizz_");


// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
function getAdSlot($slot_id){
    if($slot_id != '') {
    echo '
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- rep_ad_ahmad -->
<ins class="adsbygoogle facebookquizz-ad"
     style="display:block"
     data-ad-client="ca-pub-6154079892224305"
     data-ad-slot="'.$slot_id.'"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
    }
}
function getAdSlot2($slot_id){
    if($slot_id != '') {
    echo '    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- facequizz_result_page -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6154079892224305"
     data-ad-slot="'.$slot_id.'"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
    }
}

function getRepAdSlot($slot_id){
    if($slot_id != '') {
    echo '
       <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Ahmad Facequizz AD -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6154079892224305"
     data-ad-slot="'.$slot_id.'"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
    }
}
function manual_connect(){
    $handle=mysqli_connect(DB_HOST,DB_USER,DB_PASS) ;
    mysqli_select_db(DB_NAME,$handle);
    mysqli_query("SET NAMES 'utf8'"); 
}

function quizLink($arr = null){
        if(!isset($arr['ref'])){
        return URL ."?id=". $arr['quiz_id'];
        } else {
            return URL ."?id=". $arr['quiz_id'].'&ref='.$arr['ref'];
        }
}
function questionLink($arr = null){
        return URL ."answer/". $arr['id'];
}
function questionPage($arr){
    return URL."id/".$arr['quiz_id']."/".$arr['next_question_id']."?s=1";
}

function imageLink($arr = null){
    return URL ."image/". $arr['type'] ."-".$arr['id'];
}


function strFilter($string){
    //$string = replace_accents($string);
    $string = strtolower($string);
    $string = str_replace('&nbsp','',$string);
    $string = preg_replace("/[^a-z0-9]/", " ", $string);
    
    preg_match_all('/[0-9]+/', $string, $matches);
    
    foreach($matches[0] as $num){
        $string = str_replace($num,' '.$num.' ',$string);
    }
    
    $string = preg_replace('/\s{2,}/',' ', $string);
    $string = trim($string);
    $string = preg_replace("/[\s]/", "-", $string);
    return $string;
}

function numFilter($string){
    $string = preg_replace("/[^0-9]/", "", $string);
    return $string;
}


function r($str){
	$str = html_entity_decode($str);
    $str = htmlspecialchars_decode($str, ENT_QUOTES);
	$str = stripslashes($str);
	return mysql_real_escape_string(strip_tags($str));
}

function getIp(){
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		$ip_array = explode(",", $ip);
		$ip = $ip_array[0];
	}
	return $ip;
}


function getPages($page_no,$total_pages,$targetpage,$limit){
	$adjacents = 4;
	$page = $page_no;
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0

	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<ul class=\"nav_pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<li class=\"pagination_prev\"><a href=\"".$targetpage.$prev."\">«</a></li>";
	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li><span class=\"current\">$counter</span></li>";
				else
					$pagination.= "<li><a href=\"".$targetpage.$counter."\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li><span>$counter</span></li>";
					else
					$pagination.= "<li><a href=\"".$targetpage.$counter."\">$counter</a></li>";					
				}
				$pagination.= "<li class=\"ellipsis\">...</li>";
				$pagination.= "<li><a href=\"".$targetpage.$lpm1."\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"".$targetpage.$lastpage."\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"".$targetpage."1\">1</a></li>";
				$pagination.= "<li><a href=\"".$targetpage."2\">2</a></li>";
				$pagination.= "<li class=\"ellipsis\">...</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li><span>$counter</span></li>";
					else
					$pagination.= "<li><a href=\"".$targetpage.$counter."\">$counter</a></li>";					
				}
				$pagination.= "<li class=\"ellipsis\">...</li>";
				$pagination.= "<li><a href=\"".$targetpage.$lpm1."\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"".$targetpage.$lastpage."\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"".$targetpage."1\">1</a></li>";
				$pagination.= "<li><a href=\"".$targetpage."2\">2</a></li>";
				$pagination.= "<li class=\"ellipsis\">...</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li><span>$counter</span></li>";
					else
					$pagination.= "<li><a href=\"".$targetpage.$counter."\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li class=\"pagination_next\"><a href=\"".$targetpage.$next."\">»</a></li>";
		else
		$pagination.= "</ul>";		
	}
	return $pagination;
	}
        
function googleUrl(){
    $queries = [
        "تحليل الشخصية",
        "اختبار الشخصية",
        "اختبارات شخصية",
        "اختبار الذكاء"
    ];
    $suffixs = [
        "facequizz",
        "facequizz.com",
        "فيس كويز"
    ];
    $domains = [
        "com",
        "jo",
        "com.sa",
        "com.eg",
        "com.iq",
        "ae",
        "com.lb",
        "dz"
    ];
    $suffix = $suffixs[rand(0,count($suffixs) -1)];
    $domain = $domains[rand(0,count($domains) -1)];
    $query = $queries[rand(0,count($queries)- 1)];
    $preQuery  = urlencode($query);
    $postQuery = urlencode($query." ".$suffix);

    $url = "https://www.google.$domain/search?q=$preQuery&oq=$postQuery";
    return [
        "url" => $url,
        "query" => $query
    ];
}        
