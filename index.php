<?php

require_once('vendor/autoload.php');
include_once('ipstack/api/src/IpstackAPIClient.php');

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use foobarwhatever\dingdong\IpstackAPIClient;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    $api_key = getenv('API_KEY');
}
else {
    $api_key = getenv('API_KEY');
}

$storage = new FileStorage(__DIR__ . "/api.bucket");
$rate    = new Rate(5, Rate::MINUTE);
$bucket  = new TokenBucket(5, $rate, $storage);
$bucket->bootstrap(0);

if (!$bucket->consume(1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    exit("Limit reached! Retry-After ".floor($seconds));
}

try {

    $ipstackAPIClient = new IpstackAPIClient($api_key, false, 10);
    $response = $ipstackAPIClient->getClientLocation();

    if ($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        // If the location wasnt found run a default template
        exit("Failed to find exact location. The requester is probably using a proxy!");
    } 
    else {
        var_dump($response);
        // Define some dynamic API data variables to better determine location
        // $country_code = $response['country_code'];
        // $country_name = $response['country_name'];
        // $country_flag = $response['location']['country_flag'];
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}

?>