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
    private $public_key;

    /**
     * @var string
     */
    private $private_key;

    public function __construct($public_key, $private_key)
    {
        $this->public_key  = $public_key;
        $this->private_key = $private_key;
    }

    public function preSend(RequestInterface $request)
    {
        if ($this->public_key === null) {
            throw new \RuntimeException("You have to set credentials before using AtomRequestListener with Buzz.");
        }

        $digest = date('c') ."\n". $request->getMethod() ."\n". $request->getContentType() ."\n". md5($request->getContent());
        $signature = base64_encode(hash_hmac('sha1', $digest, $this->private_key, TRUE));

        $request->addHeader('Authorization: Atom {$this->public_key}:{$signature}');
        //$header = "X-Atom-Auth: UsernameToken Username=\"{$this->public_key}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonce64}\", Date=\"{$date}\"";

        //$request->addHeader($header);
    }

    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }

}
