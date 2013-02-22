<?php


namespace Manhattan\LogBundle\Log;

use Manhattan\LogBundle\Connection\Request;
use Manhattan\LogBundle\Connection\Client;
use Manhattan\LogBundle\Exception\FormattingException;

/**
 * 
 */
class AtomLogger
{
    /**
     * @var Manhattan\LogBundle\Connection\Client
     */
    private $client;

    /**
     * @var Manhattan\LogBundle\Client\Request
     */
    private $request;

    public function __construct(Client $client, Request $request)
    {
        $this->client = $client;
        $this->request = $request;
    }

    /**
     * Build message to send to AtomLogger
     * 
     * @param  string    $message
     * @param  integer   $level
     * @param  string    $level_name
     * @param  string    $channel
     * @param  \DateTime $datetime
     */
    public function message($message, $level, $level_name, $channel, $datetime)
    {
        $this->request->setData(array(
            'message'     => $message,
            'status_code' => $level,
            'status_name' => $level_name,
            'channel'     => $channel,
            'date'        => $datetime
        ));

        try {
            $this->client->send($this->request);
        } catch (FormattingException $e) {

        }

    }

}
