<?php


namespace Manhattan\LogBundle\Client;

use Manhattan\LogBundle\Client\Connection;

/**
 * 
 */
class Request
{

    /**
     * @var Manhattan\LogBundle\Client\Connection
     */
    private $connection;

    /**
     * @var array
     */
    private $data;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

}
