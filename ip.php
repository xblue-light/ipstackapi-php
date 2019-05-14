<?php

// Detect user IP behind Cloudflare network
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
// Determine user IP checking the 'HTTP_X_FORWARDED_FOR
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
    $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
$client  = $_SERVER['HTTP_CLIENT_IP'];
$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = $_SERVER['REMOTE_ADDR'];
if(filter_var($client, FILTER_VALIDATE_IP))
{
    $ip = $client;
}
elseif(filter_var($forward, FILTER_VALIDATE_IP))
{
    $ip = $forward;
}
else
{
    $ip = $remote;
}

echo $ip;

// $proxy_headers = array(
//     'HTTP_VIA',
//     'HTTP_X_FORWARDED_FOR',
//     'HTTP_FORWARDED_FOR',
//     'HTTP_X_FORWARDED',
//     'HTTP_FORWARDED',
//     'HTTP_CLIENT_IP',
//     'HTTP_FORWARDED_FOR_IP',
//     'VIA',
//     'X_FORWARDED_FOR',
//     'FORWARDED_FOR',
//     'X_FORWARDED',
//     'FORWARDED',
//     'CLIENT_IP',
//     'FORWARDED_FOR_IP',
//     'HTTP_PROXY_CONNECTION'
// );
// foreach($proxy_headers as $x){
//     if (isset($_SERVER[$x])) die("You are using a proxy!");
//     else die('Erm, doesnt seem like your using a proxy...');
// }

// $server = $_SERVER;
// foreach ($server as $key => $value) {
//     echo "{$key} => {$value} <br/>";
// }

?>