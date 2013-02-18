<?php


namespace Manhattan\LogBundle\Log;

use Buzz\Browser;

/**
 * Makes a connection between the Logging server and the client.
 */
class Connection
{
    /**
     * @var Buzz\Browser
     */
    private $browser;

    /**
     * @var Manhattan\LogBundle\Log\Site
     */
    private $site;

    /**
     * Constructs a new Connection object that will go to a specific
     * CatchError server location.
     *
     * @param Browser $browser
     */
    public function __construct(Browser $browser, Site $site)
    {
        $this->browser = $browser;
        $this->site = $site;
    }

}