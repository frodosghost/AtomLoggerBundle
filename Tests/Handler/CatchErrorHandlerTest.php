<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\Tests\Handler;

use Atom\LoggerBundle\Handler\CatchErrorHandler;

/**
 * Test the CatchErrorHandler
 */
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
