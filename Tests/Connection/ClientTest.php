<?php

/**
 * Test the ConnectionTest
 */

namespace Manhattan\LogBundle\Tests\Connection;

use Manhattan\LogBundle\Connection\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    private $mock_buzz;

    private $mock_configuration;

    private $mock_request;

    public function setUp()
    {
        $this->mock_buzz = $this->getMock('Buzz\Browser');
        $this->mock_configuration = $this->getMockBuilder('Manhattan\LogBundle\Log\Configuration')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mock_request = $this->getMockBuilder('Manhattan\LogBundle\Connection\Request')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new Client($this->mock_buzz, $this->mock_configuration);
        $this->assertInstanceOf('Manhattan\LogBundle\Connection\Client', $handler);
    }

    public function testSendException()
    {
        $this->mock_buzz->expects($this->any())
            ->method('post')
            ->will($this->throwException(new \Exception));

        $client = new Client($this->mock_buzz, $this->mock_configuration);

        $this->setExpectedException('RuntimeException');
        $client->send($this->mock_request);
    }

    public function testSend()
    {
        $this->mock_buzz->expects($this->any())
            ->method('post')
            ->will($this->returnValue('foo'));

        $client = new Client($this->mock_buzz, $this->mock_configuration);

        $this->assertEquals('foo', $client->send($this->mock_request));
    }

}
