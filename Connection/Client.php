<?php


namespace Atom\LoggerBundle\Connection;

use Buzz\Browser;
use Buzz\Message\Response;
use Buzz\Client\AbstractClient;
use Buzz\Listener\ListenerInterface;

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
     * @var string
     */
    private $atomSiteKey;

    /**
     * Constructs a new Connection object that will go to a specific
     * CatchError server location.
     *
     * @param Browser $browser
     * @param string  $atomUri
     */
    public function __construct(Browser $browser, ListenerInterface $headerListener, $atomUri)
    {
        $this->browser = $browser;
        $this->atomUri = $atomUri;

        $this->browser->addListener($headerListener);

        if ($this->browser->getClient() instanceof AbstractClient) {
            $this->browser->getClient()->setTimeout(1337);
        }
    }

    /**
     * Send the Request
     * 
     * @param  Request  $request
     * @return Response
     */
    public function send(Request $request)
    {
        $headers = array('Content-Type' => $request->getContentType());
        $content = $request->formatData();

        if ($this->hasSiteKey()) {
            $headers = array_merge($headers, array('x-atom-log-id' => $this->getSiteKey()));
        }

        try {
            $response = $this->getBrowser()->post($this->getAtomUri(), $headers, $content);
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

    /**
     * Sets the Site Key to be set with the Headers
     * 
     * @param string $atomSiteKey
     */
    public function setSiteKey($atomSiteKey)
    {
        $this->atomSiteKey = $atomSiteKey;
    }

    /**
     * @return string
     */
    public function getSiteKey()
    {
        return $this->atomSiteKey;
    }

    /**
     * Determines if the Site Key has been set
     * 
     * @return boolean
     */
    public function hasSiteKey()
    {
        return isset($this->atomSiteKey) && ($this->atomSiteKey !== "" && !is_null($this->atomSiteKey));
    }

}
