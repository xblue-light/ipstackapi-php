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

$response = $ipstackAPIClient->getClientLocation();
// Dump the response into an array
var_dump($response);
```


#### Instantiate new location:

```php
$api_key = "API_KEY_GOES_HERE";

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
        // Ouputs location array recieved from sucessful response
        var_dump($location);
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}
```