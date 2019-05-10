<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/tables.php';

    // Determine the users real public IP
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    //$keyAPI = '5c38541aa3437c11073df2b6c03fa79e';
    $keyAPI = '';
    
    // Initialize CURL
    $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$keyAPI.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
  
    // Decode JSON response:
    $resultJSON = json_decode($json, true);

    // Define some dynamic API data variables to better determine location
    $country_code = $resultJSON['country_code'];
    $country_name = $resultJSON['country_name'];
    $country_flag = $resultJSON['location']['country_flag'];
    $publicIP = $resultJSON['ip'];
  
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
      'public_ip'    => $publicIP,
    );
    
    // Pass these data variables from API down to our get_geolocation_tables() function
    $is_country_name  = $atts['country_name'];
    $is_country_code  = $atts['country_code'];
    $country_flag_url = $atts['country_flag'];
    $public_ip        = $atts['public_ip'];
    
    return get_geolocation_tables($is_country_name, $is_country_code, $country_flag_url, $public_ip);
  
    // echo "<img src='{$country_flag}' alt='{$country_name}' width='75' height='50' />";
    // if ($country_name === 'Denmark' && $country_code === 'DK') {
    // 	echo 'Location detected: ' . $country_name;
    // 	include get_template_directory() . '/tables/beta.php';
    // }
    // else if ($country_name === 'Bulgaria' && $country_code === 'BG') {
    // 	echo 'Location detected: ' . $country_name;
    // 	include get_template_directory() . '/tables/gamma.php';
    // }
    // else {
    // 	echo 'Location detected: ' . $country_name;
    // 	include get_template_directory() . '/tables/alpha.php';
    // }
    //Output the "languages" array inside "location"
    // foreach ($resultJSON['location']['languages'][0] as $key => $value) {
    // 	echo $value . '<br/>';
    // }
    // if ($resultJSON['location']['languages'][0]['code'] === 'se') {
    // 	echo 'You are currently NOT from BG!';
    // }
?>
