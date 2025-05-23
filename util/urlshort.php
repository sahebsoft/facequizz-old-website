<?php
    define('GOOGLE_API_KEY', 'AIzaSyAhJdEy76sVbD9iOVtqqYlOBgGMpZT_SQg');
    define('GOOGLE_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');
	
    function shortenUrl($longUrl)
    {
        $ch = curl_init(sprintf('%s/url?key=%s', GOOGLE_ENDPOINT, GOOGLE_API_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $requestData = array('longUrl' => $longUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
 
    //$response = shortenUrl('http://www.downloads.ws/android/app/com-mobage-ww-a1431-Puzzles_Android');
	//echo  $response['id'];

?>
