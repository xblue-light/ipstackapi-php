<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
$client = new Client();

// $promise = $client->requestAsync(
// 	'GET',
//     'http://jsonplaceholder.typicode.com/posts/1'
// );

$promise = $client->requestAsync(
    'GET', 
    'https://randomuser.me/api/'
);

$promise->then(
	function (Response $resp) {
        $array = json_decode($resp->getBody()->getContents(), true);
        var_dump($array['results'][0]['picture']['medium']);
        //echo "<img src=\"{$array['results'][0]['picture']['medium']}\" class=\"img-responsive\" alt=\"Image Alt\" />";
        // echo "<br/>";
		// echo $resp->getBody();
	},
	function (RequestException $e) {
		echo $e->getMessage();
	}
);

echo 'Geolocation API via ipstack.com';
echo '</br>';

$promise->wait();



