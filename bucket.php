<?php

require 'vendor/autoload.php';
use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\storage\StorageException;

$storage = new FileStorage(__DIR__ . "/api.bucket");
$rate    = new Rate(10, Rate::MINUTE);
$bucket  = new TokenBucket(10, $rate, $storage);
$bucket->bootstrap(10);

if (!$bucket->consume(1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    exit("Fvck!");
}

echo "API response";

?>