<?php


namespace Atom\LoggerBundle\Connection;

use Buzz\Browser;
use Buzz\Message\Response;

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
     * @var string
     */
    private $atomUri;

    /**
     * Constructs a new Connection object that will go to a specific
     * CatchError server location.
     *
     * @param Browser $browser
     * @param string  $atomUri
     */
    public function __construct(Browser $browser, $atomUri)
    {
        $this->browser = $browser;
        $this->atomUri = $atomUri;
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
            $response = $this->getBrowser()->post($this->getAtomUri(), array(), $content);
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

    /**
     * @return string
     */
    public function getAtomUri()
    {
        return $this->atomUri;
    }

}
