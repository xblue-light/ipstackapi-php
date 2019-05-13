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
    
    if ($location === null || $location['country_name'] === null) {
        // If the location wasnt found run a default template
        echo 'Failed to find location. Load some defaults here, clearly something went wrong!'.PHP_EOL;
    } else {
        
        // DEBUGGER ============>>>>>>>>>>>>>>>>
        echo '<pre>';
        var_dump($location);
        echo '</pre>';
        return
        // ============>>>>>>>>>>>>>>>>>>>>>>>>>>

        // Define some dynamic API data variables to better determine location
        $country_code = $location['country_code'];
        $country_name = $location['country_name'];
        $country_flag = $location['location']['country_flag'];
        $public_ip    = $location['ip'];

    }
}
catch (\Exception $e) {
    echo $e->getMessage();
    //echo 'Default behaviour should be happening here, load some default tables etc. Error '. $e;
}

?>