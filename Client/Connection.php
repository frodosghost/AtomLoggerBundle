<?php


namespace Manhattan\LogBundle\Client;

use Buzz\Browser;

/**
 * Makes a connection between the eWay server and the client.
 */
class Connection
{
    /**
     * @var Buzz\Browser
     */
    private $browser;

    /**
     * Constructs a new Connection object that will go to a specific
     * CatchError server location.
     *
     * @param Browser $browser
     */
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

}