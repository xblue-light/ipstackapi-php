### IPStack Geo API - PHP

#### A simple PHP wrapper leveraging [Guzzle](http://docs.guzzlephp.org/en/stable/) which attempts to determine a visitors geographical location. 

#### Install project dependencies:

`$ composer install`

#### Dont have Composer installed? Learn how to install it here: [getcomposer.org](https://getcomposer.org/download/)

#### Preview [demo](https://fathomless-beach-32451.herokuapp.com/)

#### Learn more about IPStack here: [ipstack.com](https://ipstack.com/)

#### Basic usage:

```php
$ipstackAPIClient = new IpstackAPIClient(
    'API_KEY_GOES_HERE', // API Key
    false, // Use HTTPS (IPStack Basic plan and up only, defaults to false)
    10 // Timeout in seconds (defaults to 10 seconds)
);

// Call the getClientLocation() method which returns an array with the visitor location/ip details.
$response = $ipstackAPIClient->getClientLocation();

// Dump the response variable
var_dump($response);
```


#### Alternative usage:

```php
$api_key = "API_KEY_GOES_HERE";

try {
    
    $ipstackAPIClient = new IpstackAPIClient($api_key, false, 10);
    $location = $ipstackAPIClient->getClientLocation();
    
    // Error checking to determine if the response array has certain key values set.
    // I noticed if a visitor is using a proxy of some sort these key values can be often unset/null.
    if ($response === null || $response['country_name'] === null || $response['country_code'] === null) {
        echo "Failed to find a location";
    } else {
        // Dump location variable
        var_dump($location);
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}
```

#### Limit rate usage:
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
        exit("Limit reached! Retry after: " . floor($seconds));
    }

    $ipstackAPIClient = new IpstackAPIClient($api_key, false, 10);
    $response = $ipstackAPIClient->getClientLocation();

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

Inspired by and credits also go to: [ipstackgeo-php](https://github.com/nathan-fiscaletti/ipstackgeo-php), [bandwith-throttle](https://github.com/bandwidth-throttle/bandwidth-throttle), [ipstack.com](https://ipstack.com/), [phpdotenv](https://github.com/vlucas/phpdotenv)
