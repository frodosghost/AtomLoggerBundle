<?php

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
    public function __construct(AtomLogger $atomLogger, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->atomLogger = $atomLogger;
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