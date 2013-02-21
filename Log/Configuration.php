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
    private $api_key;

    /**
     * @var string
     */
    private $uri;

    /**
     * Constructs a new Configuration instance for connection to ServerLog
     *
     * @param string $api_key API Key as required by site setup
     * @param string $uri     URI to send requests to for error handling
     */
    public function __construct($api_key, $uri)
    {
        $this->api_key = $api_key;
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

}
