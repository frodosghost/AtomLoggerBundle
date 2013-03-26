<?php


namespace Atom\LoggerBundle\Connection;

/**
 * Creates a Configuration Instance to start connection to ServerLog
 */
class Configuration
{
    /**
     * @var string
     */
    private $public_key;

    /**
     * @var string
     */
    private $private_key;

    /**
     * @var string
     */
    private $uri;

    /**
     * Constructs a new Configuration instance for connection to AtomLogger
     *
     * @param string $public_key  HMAC Public Key
     * @param string $private_key HMAC Private Key
     * @param string $uri         URI to send requests to for error handling
     */
    public function __construct($public_key, $private_key, $uri)
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
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
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }
}
