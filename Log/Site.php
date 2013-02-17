<?php


namespace Manhattan\LogBundle\Log;

/**
 * Creates a Site Instance to start connection to ServerLog
 */
class Site
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
     * Constructs a new Site instance for connection to ServerLog
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
