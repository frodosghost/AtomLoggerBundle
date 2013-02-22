<?php

/**
 * Test the CatchErrorHandler
 */

namespace Atom\LoggerBundle\Tests\Handler;

use Atom\LoggerBundle\Handler\CatchErrorHandler;

class CatchErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $mock_logger;

    public function setUp()
    {
        $this->mock_logger = $this->getMockBuilder('Atom\LoggerBundle\Log\AtomLogger')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @covers Atom\LoggerBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new CatchErrorHandler($this->mock_logger);
        $this->assertInstanceOf('Atom\LoggerBundle\Handler\CatchErrorHandler', $handler);
    }

    public function testWrite()
    {
        $handler = new CatchErrorHandler($this->mock_logger);
        $this->assertFalse($handler->handle(array(
            'message' => 'test',
            'context' => array(),
            'level' => 500,
            'level_name' => 'CRITICAL',
            'channel' => 'test',
            'datetime' => \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true))),
            'extra' => array(),
        )));
    }

}
