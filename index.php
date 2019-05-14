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

    $response = $ipstackAPIClient->getClientLocation();
    
    // DEBUGGER ============>>>>>>>>>>>>>>>>
    // echo '<pre>';
    // var_dump($response);
    // echo '</pre>';
    // return;

    // foreach($response as $name => $value) {
    //     $value = implode(', ', $value);
    //     echo "{$name}: {$value}\r\n";
    //     echo '<br/>';
    // }

    if ($response === NULL || $response['country_name'] === NULL) {
        // If the location wasnt found run a default template
        echo 'Failed to find location. Load some defaults here, clearly something went wrong!'.PHP_EOL;
    } else {
        var_dump($response);
        // Define some dynamic API data variables to better determine location
        // $country_code = $response['country_code'];
        // $country_name = $response['country_name'];
        // $country_flag = $response['location']['country_flag'];
        // $public_ip    = $response['ip'];
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}

?>