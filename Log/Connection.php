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

    public function message($message, $level, $level_name=null, $channel=null, \DateTime $datetime=null)
    {
        echo '<pre>';
        print_r($message);
        echo '</pre>';
        exit;
        $datetime->setTimezone(new \DateTimeZone('UTC'));
        $datetime->format('Y-m-d H:i:s');
    }

}
