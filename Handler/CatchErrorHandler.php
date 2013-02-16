<?php

namespace Manhattan\LogBundle\Handler;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

use Manhattan\LogBundle\Client\Connection;

/**
* Handler to send messages to a CatchError server
*
* @author James Rickard <james@frodosghost.com>
*/
class CatchErrorHandler extends AbstractProcessingHandler
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param integer $level The minimum logging level at which this handler will be triggered
     * @param Boolean $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(Connection $connection, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        /*$this->ravenClient->captureMessage(
            $record['formatted'],
            array(), // $params - not used
            $this->logLevels[$record['level']], // $level
            false // $stack
        );
        if ($record['level'] >= Logger::ERROR && isset($record['context']['exception'])) {
            $this->ravenClient->captureException($record['context']['exception']);
        }*/
    }

}