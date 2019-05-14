<?php

// Make sure we have a session scope
session_start();

// set the variables that define the limits:
$min_time = 5; // seconds
$max_requests = 5;


// Create our requests array in session scope if it does not yet exist
if (!isset($_SESSION['requests'])) {
    $_SESSION['requests'] = [];
}

// Create a shortcut variable for this array (just for shorter & faster code)
$requests = &$_SESSION['requests'];

$countRecent = 0;
$repeat = false;
foreach($requests as $request) {
    // See if the current request was made before
    if ($request["userid"] == $id) {
        $repeat = true;
    }
    // Count (only) new requests made in last minute
    if ($request["time"] >= time() - $min_time) {
        $countRecent++;
    }
}

// Only if this is a new request...
if (!$repeat) {
    // Check if limit is crossed.
    // NB: Refused requests are not added to the log.
    if ($countRecent >= $max_requests) {
        die("Too many new ID requests in a short time");
    }   
    // Add current request to the log.
    $countRecent++;
    $requests[] = ["time" => time(), "userid" => $id];
}

// Debugging code, can be removed later:
echo count($requests) . " unique ID requests, of which $countRecent in last minute.<br>"; 

// if execution gets here, then proceed with file content lookup as you have it.

?>