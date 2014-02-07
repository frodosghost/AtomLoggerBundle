<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\Log;

use Atom\LoggerBundle\Connection\Request;
use Atom\LoggerBundle\Connection\Client;
use Atom\LoggerBundle\Exception\FormattingException;

/**
 *
 */
class AtomLogger
{
    /**
     * @var Atom\LoggerBundle\Connection\Client
     */
    private $client;

    /**
     * @var Atom\LoggerBundle\Client\Request
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
        $datetime->setTimezone(new \DateTimeZone('UTC'));

        $this->request->setData(array(
            'message'     => $message,
            'status_code' => $level,
            'status_name' => $level_name,
            'channel'     => $channel,
            'created_utc' => $datetime->format('Y-m-d H:i:s')
        ));

        try {
            $this->client->send($this->request);
        } catch (FormattingException $e) {

        }
    }

    /**
     * @return Atom\LoggerBundle\Connection\Client
     */
    public function getClient()
    {
        return $this->client;
    }

}
