<?php
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT']);
require APP_ROOT.'/vendor/autoload.php';
require APP_ROOT.'/ipstack/api/src/IpstackAPIClient.php';
use foobarwhatever\dingdong\IpstackAPIClient;

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
    // Instantiate new object
    $ipstackAPIClient = new IpstackAPIClient(
        $api_key, // API Key
        false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
        10 // Timeout in seconds (defaults to 10 seconds)
    );

    $response = $ipstackAPIClient->getClientLocation();
    
    // DEBUGGER ============>>>>>>>>>>>>>>>>
    // var_dump($response);
    // return;

    if ($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        // If the location wasnt found run a default template
        die("Failed to find exact location. The requester is probably using a proxy!");
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