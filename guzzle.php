<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();

$access_key = '5c38541aa3437c11073df2b6c03fa79e';

// Determine the users real public IP
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$response = $client->request(
	'GET',
    //'http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'',
    'http://api.ipstack.com/check?access_key='.$access_key.'',
);

var_dump($response);
//echo $response->getBody();


?>