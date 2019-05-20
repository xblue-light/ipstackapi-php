<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ipstack/api/src/IpstackAPIClient.php');

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\storage\StorageException;
use ipstack\api\src\IpstackAPIClient;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    $api_key = getenv('API_KEY');
}
else {
    $api_key = getenv('API_KEY');
}

try {

    // This will limit the rate of a global resource to 5 requests per minute for all requests.
    $storage = new FileStorage(__DIR__ . "/api.bucket");
    $rate    = new Rate(5, Rate::MINUTE);
    $bucket  = new TokenBucket(5, $rate, $storage);
    $bucket->bootstrap(0);

    // The method consume() will either return true if the tokens were consumed or false with 429 status.
    if (!$bucket->consume(1, $seconds)) {
        http_response_code(429);
        header(sprintf("Retry-After: %d", floor($seconds)));
        exit("Limit reached! Retry-After ".floor($seconds));
    }

    // Instantiate the IpstackAPIClient object and set some default parameters.
    $ipstackAPIClient = new IpstackAPIClient($api_key, false, 10);

    $response = $ipstackAPIClient->getClientLocation();

    // Error checking if the location values were not found.
    // This statement could be used to load default HTML template in case API fails to load or whatever.
    if ($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        exit("Failed to find exact location.");
    } 
    else {
        var_dump($response);
        // $country_code = $response['country_code'];
        // $country_name = $response['country_name'];
        // $country_flag = $response['location']['country_flag'];
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}

?>