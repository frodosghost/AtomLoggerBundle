<?php


namespace Manhattan\LogBundle\Log;

/**
 * Creates a Configuration Instance to start connection to ServerLog
 */
class Configuration
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $api_key;

    /**
     * Constructs a new Configuration instance for connection to ServerLog
     * 
     * @param string $uri     URI to send requests to for error handling
     * @param string $api_key API Key as required by site setup
     */
    public function __construct($uri, $api_key)
    {
        $this->uri = $uri;
        $this->api_key = $api_key;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $uri;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $api_key;
    }

}
