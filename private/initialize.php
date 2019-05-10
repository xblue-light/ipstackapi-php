<?php

// Perform all initialization here, in private

// Set constants to easily reference public 
// and private directories
define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . "/private");

require_once(PRIVATE_PATH . "/functions/general_functions.php");
require_once(PRIVATE_PATH . "/functions/api.php");


?>