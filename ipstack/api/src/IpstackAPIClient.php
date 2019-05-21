<?php

namespace ipstack\api\src;

use GuzzleHttp\Client;

/**
 * A simple PHP wrapper leveraging Guzzle to send a synchronous request using the IPStack Geo API.
 * This class can be modified to work with different API services other than ipstack.com.
 *
 * @author Paul Bowyer <xorange@protonmail.com>
 * @link xblue.nl
 */

Class IpstackAPIClient
{

    /**
     * The timeout for the current server.
     *
     * @var int
     */
    private $timeout;

    /**
     * The API key used to connect to the IPStack API.
     *
     * @var string
     */
    private $api_key;

    /**
     * If set to true, HTTPS will be used for the connection.
     *
     * @var bool
     */
    private $use_https;

    /**
     * Construct the ipstack.com object with server information.
     * Defaults to ipstack.com.
     *
     * @param string      $api_key
     * @param bool        $use_https
     * @param int         $timeout
     */

    public function __construct( string $api_key, bool $use_https = false, int $timeout = 10 ) {
        $this->timeout   = $timeout;
        $this->api_key   = $api_key;
        $this->use_https = $use_https;
    }

    /**
     * Retrieve a location for a specific IP address.
     *
     * @throws \Exception
     * 
     */
    public function getClientLocation()
    {
        $results = null;

        try {

            // Attempt to determine a visitors public IP address.
            if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
            {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            }
            elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) 
            {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            
            $client  = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : null;
            $forward = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
            $remote  = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;

            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }

            $request_query = (new Client([
                'base_uri' => (
                    ($this->use_https)
                        ? 'https'
                        : 'http'
                ).'://api.ipstack.com/', // Base URI
                'timeout'  => $this->timeout, // Response timeout
                'headers'  => [ // Define headers
                    'Content-Type' => 'application/json' 
                ],
                
            ]))->get($ip.'?access_key='.$this->api_key);
            
            // If the response status code from our request is 200 then proceed
            if($request_query->getStatusCode() === 200) {
                // Request response data array and decode
                $compiled = json_decode($request_query->getBody()->getContents(), true);
                // If an array key error exists within the $compiled array then there must be an error throw exception.
                if(array_key_exists('error', $compiled)) {
                    throw new \Exception('Error: '.$compiled['error']['info']);
                }
                // Finally store our response into $results
                $results = $compiled;
            }
        } 
        catch (\Exception $e) {
            throw $e;
        }
        
        return $results;
    }

}

?>
