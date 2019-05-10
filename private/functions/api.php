<?php

    //set IP address and API access key 
    $keyAPI = '5c38541aa3437c11073df2b6c03fa79e';

    //Initialize CURL:
    $ch = curl_init('http://api.ipstack.com/check?access_key='.$keyAPI.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    //Decode JSON response:
    $api_result = json_decode($json, true);

    //Output the "languages" array inside "location"
    foreach ($api_result['location']['languages'][0] as $key => $value) {
        echo $value . '<br/>';
    }

    if ($api_result['location']['languages'][0]['code'] === 'se') {
        echo 'You are currently NOT from BG!';
    }
    else {
        echo 'Hello!';
    }

    echo ('<pre>');
    print_r ($api_result);
    echo ('</pre>');

    


  

?>

