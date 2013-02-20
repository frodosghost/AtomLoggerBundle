<?php


namespace Manhattan\LogBundle\Connection;

use Manhattan\LogBundle\Connection\Client;

/**
 * @author James Rickard <james@frodosghost.com>
 */
class Request
{

    /**
     * @var Manhattan\LogBundle\Connection\Client
     */
    private $client;

    /**
     * @var array
     */
    private $data;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

}
