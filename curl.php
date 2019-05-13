<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/tables.php';    
    $api_key = '5c38541aa3437c11073df2b6c03fa79e';

    // Determine the users real public IP
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Initialize CURL
    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$api_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
  
    // Decode JSON response:
    $responseArray = json_decode($json, true);

    // Define some dynamic API data variables to better determine location
    $country_code = $responseArray['country_code'];
    $country_name = $responseArray['country_name'];
    $country_flag = $responseArray['location']['country_flag'];
    $public_ip    = $responseArray['ip'];
  
    // ============================>> DEBUGGER ****
    // echo ('<pre>');
    // print_r ($resultJSON);
    // echo ('</pre>');
    // return
  
    // Build our shortcode array which we can then pass down to our template
    $atts = array (
      'country_name' => $country_name,
      'country_code' => $country_code,
      'country_flag' => $country_flag,
      'public_ip'    => $public_ip,
    );
    
    // Pass these data variables from API down to our get_geolocation_tables() function
    $is_country_name  = $atts['country_name'];
    $is_country_code  = $atts['country_code'];
    $country_flag_url = $atts['country_flag'];
    $public_ip        = $atts['public_ip'];
    
    get_geolocation_tables($is_country_name, $is_country_code, $country_flag_url, $public_ip);
  
?>
