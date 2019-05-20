<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ipstack/api/src/IpstackAPIClient.php');

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\storage\StorageException;
use ipstack\api\src\IpstackAPIClient;

if(file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    $api_key = getenv('API_KEY');
}
else {
    $api_key = getenv('API_KEY');
}

try {
    
    $storage = new FileStorage(__DIR__ . "/api.bucket");
    $rate    = new Rate(5, Rate::MINUTE);
    $bucket  = new TokenBucket(5, $rate, $storage);
    $bucket->bootstrap(0);

    if(!$bucket->consume(1, $seconds)) {
        http_response_code(429);
        header(sprintf("Retry-After: %d", floor($seconds)));
        exit("Limit reached! Retry after: " . floor($seconds));
    }

    $ipstackAPIClient = new IpstackAPIClient($api_key, false, 10);
    $response = $ipstackAPIClient->getClientLocation();

    if($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        exit("Failed to find exact location.");
    } 
    else {
        var_dump($response);
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}

?>