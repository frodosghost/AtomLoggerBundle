<?php

/**
 * Test the CatchErrorHandler
 */

namespace Atom\LoggerBundle\Tests\Handler;

use Atom\LoggerBundle\Handler\CatchErrorHandler;

class CatchErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $mockLogger;

    public function setUp()
    {
        $mockClient = $this->getMockBuilder('Atom\LoggerBundle\Connection\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $mockRequest = $this->getMockBuilder('Atom\LoggerBundle\Connection\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockLogger = $this->getMock('Atom\LoggerBundle\Log\AtomLogger', array(), array($mockClient, $mockRequest));
        $this->mockLogger->expects($this->any())
             ->method('getClient')
             ->will($this->returnValue($mockClient));
    }

    /**
     * @covers Atom\LoggerBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new CatchErrorHandler($this->mockLogger, 'foo');
        $this->assertInstanceOf('Atom\LoggerBundle\Handler\CatchErrorHandler', $handler);
    }

    public function testWrite()
    {
        $handler = new CatchErrorHandler($this->mockLogger, 'foo');
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
