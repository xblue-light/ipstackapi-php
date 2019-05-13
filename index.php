<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/IPStack/initialize.php');
use IPStack\PHP\IpstackAPIClient;

try {
    //$access_key = "5c38541aa3437c11073df2b6c03fa79e";
    $ipstackAPIClient = new IpstackAPIClient(
        '', // API Key
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