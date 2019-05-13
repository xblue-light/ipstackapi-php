<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/IPStack/initialize.php');
use IPStack\PHP\IpstackAPIClient;

// Load .env into current file
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    $api_key = getenv('API_KEY');
}
else {
    $api_key = getenv('API_KEY');
}

try {
    $ipstackAPIClient = new IpstackAPIClient(
        $api_key, // API Key
        false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
        10 // Timeout in seconds (defaults to 10 seconds)
    );

    $location = $ipstackAPIClient->getClientLocation();
    
    if ($location == NULL) {
        echo 'Failed to find location.'.PHP_EOL;
    } else {
        // Convert the location to a standard PHP array.
        //echo $location['longitude'] . PHP_EOL;
        var_dump($location);
    }
}
catch (\Exception $e) {
    // echo $e->getMessage();
    // echo PHP_EOL;
    echo 'Default behaviour should be happening here, load some default tables etc.';
}


?>