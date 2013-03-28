<?php

namespace Atom\LoggerBundle\EventListener;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;

class AtomRequestListener implements ListenerInterface
{
    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @var string
     */
    private $siteKey;

    public function __construct($publicKey, $privateKey)
    {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function preSend(RequestInterface $request)
    {
        if ($this->publicKey === null) {
            throw new \RuntimeException("You have to set credentials before using AtomRequestListener with Buzz.");
        }

        $time = new \DateTime();
        $time->setTimezone(new \DateTimeZone('UTC'));

        $digest = $time->format('c') ."\n". $request->getMethod() ."\n". $request->getHeader('Content-Type') ."\n". md5($request->getContent());
        $signature = base64_encode(hash_hmac('sha1', $digest, $this->privateKey, TRUE));

        $request->addHeader("Authorization: Atom {$this->publicKey}:{$signature}");
    }

    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }

}
