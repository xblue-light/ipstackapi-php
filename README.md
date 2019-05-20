### This is a ipstack PHP/Guzzle API class for retrieving a users geolocation and public IP.

#### Install dependencies:

`$ composer install`


#### Basic usage:

```php
$ipstackAPIClient = new IpstackAPIClient(
    'API_KEY_GOES_HERE', // API Key
    false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
    10 // Timeout in seconds (defaults to 10 seconds)
);

// Call the getClientLocation() method which returns an array with the visitors location/ip details
$response = $ipstackAPIClient->getClientLocation();
// Dump the response into an array
var_dump($response);
```


#### Alternative example:

```php
$api_key = "API_KEY_GOES_HERE";

try {
    $ipstackAPIClient = new IpstackAPIClient(
        $api_key, // API Key
        false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
        10 // Timeout in seconds (defaults to 10 seconds)
    );

    $location = $ipstackAPIClient->getClientLocation();
    // Error handling ideal for outputting default template/page.
    if ($location == NULL) {
        echo 'Failed to find location.'.PHP_EOL;
    } else {
        // Ouputs location array recieved from sucessful response
        var_dump($location);
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}
```

### Usage with limit rate 
```php
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

    // Instantiate a new object and set some default parameters.
        $ipstackAPIClient = new IpstackAPIClient(
        $api_key, // API Key
        false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
        10 // Timeout in seconds (defaults to 10 seconds)
    );
    
    // Call the getClientLocation() method which returns an array with the visitors location/ip details
    $response = $ipstackAPIClient->getClientLocation();

    // Error checking to determine if our response array has certain key values set.
    // Often I noticed if a visitor is using a proxy these key values can be unset/null.
    if ($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        exit("Failed to find exact location.");
    } 
    else {
        var_dump($response);
        echo $response['country_code'];
        echo "<br/>";
        echo $response['country_name'];
        echo "<br/>";
        echo $response['location']['country_flag'];
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}
```