<?php


namespace Atom\LoggerBundle\Connection;

use Buzz\Browser;
use Buzz\Message\Response;
use Atom\LoggerBundle\Log\Configuration;

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
     * @var Atom\LoggerBundle\Log\Configuration
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

    /**
     * Send the Request
     * 
     * @param  Request  $request
     * @return Response
     */
    public function send(Request $request)
    {
        $content = $request->formatData();

        try {
            $response = $this->getBrowser()->post('url', 'headers', $content);
        } catch(\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }

        return $response;
    }

    /**
     * @return Buzz\Browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }
}
