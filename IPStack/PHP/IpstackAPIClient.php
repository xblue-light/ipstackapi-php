<?php

namespace IPStack\PHP;
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

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
     * Construct the FreeGeoIp object with server information.
     * Defaults to freegeoip.net.
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
     */
    public function getClientLocation()
    {
        $results = NULL;

        try {

            // Get real visitor IP behind CloudFlare network
            if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            }
            $client  = $_SERVER['HTTP_CLIENT_IP'];
            $forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];
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

            //$ip = 'check';

            $response = (new Client([
                'base_uri' => (
                    ($this->use_https)
                        ? 'https'
                        : 'http'
                ).'://api.ipstack.com/',
                'timeout' => $this->timeout,
            ]))->get($ip.'?access_key='.$this->api_key.'&output=json');

            if ($response->getStatusCode() == 200) {
                
                $compiled = json_decode($response->getBody()->getContents(), true);

                if (array_key_exists('error', $compiled)) {
                    //throw new \Exception('Error: '.$compiled['error']['info']);
                    throw new \Exception('Throwing new fvck! =>'.$compiled['error']['info']);
                }

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