<?php


namespace Manhattan\LogBundle\Connection;

use Buzz\Browser;
use Manhattan\LogBundle\Log\Configuration;

/**
 * Makes a connection between the Logging server and the client.
 */
class Client
{
    /**
     * @var Buzz\Browser
     */
    private $browser;

    /**
     * @var Manhattan\LogBundle\Log\Configuration
     */
    private $configuration;

    /**
     * Constructs a new Connection object that will go to a specific
     * CatchError server location.
     *
     * @param Browser $browser
     */
    public function __construct(Browser $browser, Configuration $configuration)
    {
        $this->browser = $browser;
        $this->configuration = $configuration;
    }

}
