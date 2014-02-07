<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\Handler;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

use Atom\LoggerBundle\Log\AtomLogger;

/**
* Handler to send messages to a AtomLogger server
*
* @author James Rickard <james@frodosghost.com>
*/
class CatchErrorHandler extends AbstractProcessingHandler
{
    /**
     * @var AtomLogger
     */
    private $atomLogger;

    /**
     * @param AtomLogger $atomLogger Class passed in to Log to AtomLogger
     * @param integer    $level      The minimum logging level at which this handler will be triggered
     * @param Boolean    $bubble     Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(AtomLogger $atomLogger, $siteKey, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->atomLogger = $atomLogger;

        if (!is_null($siteKey)) {
            $this->atomLogger->getClient()->setSiteKey($siteKey);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        $this->atomLogger->message(
            $record['message'],
            $record['level'],
            $record['level_name'],
            $record['channel'],
            $record['datetime']
        );
    }

}
