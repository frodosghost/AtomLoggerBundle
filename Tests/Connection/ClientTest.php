<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\Tests\Connection;

use Atom\LoggerBundle\Connection\Client;

/**
 * Test the ConnectionTest
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    private $mock_buzz;

    private $mock_configuration;

    private $mock_request;

    public function setUp()
    {
        $mock_client = $this->getMock('Buzz\Client\AbstractClient');
        $mock_client->expects($this->any())->method('setTimeout')->with(1337);

        $this->mock_buzz = $this->getMock('Buzz\Browser');
        $this->mock_buzz->expects($this->any())->method('getClient')->will($this->returnValue($mock_client));
        $this->mockListener = $this->getMock('Buzz\Listener\ListenerInterface');
        $this->mock_request = $this->getMockBuilder('Atom\LoggerBundle\Connection\Request')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @covers Atom\LoggerBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new Client($this->mock_buzz, $this->mockListener, 'foo');
        $this->assertInstanceOf('Atom\LoggerBundle\Connection\Client', $handler);
    }

    public function testSendException()
    {
        $this->mock_buzz->expects($this->any())
            ->method('post')
            ->will($this->throwException(new \Exception));

        $client = new Client($this->mock_buzz, $this->mockListener, 'foo');

        $this->setExpectedException('RuntimeException');
        $client->send($this->mock_request);
    }

    public function testSend()
    {
        $this->mock_buzz->expects($this->any())
            ->method('post')
            ->will($this->returnValue('foo'));

        $client = new Client($this->mock_buzz, $this->mockListener, 'foo');

        $this->assertEquals('foo', $client->send($this->mock_request));
    }

}
