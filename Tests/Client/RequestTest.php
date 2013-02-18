<?php

/**
 * Test the Request
 */

namespace Manhattan\LogBundle\Tests\Client;

use Manhattan\LogBundle\Client\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Client\Request::__construct
     */
    public function testConstruct()
    {
        $mock_connection = $this->getMockBuilder('Manhattan\LogBundle\Client\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new Request($mock_connection);
        $this->assertInstanceOf('Manhattan\LogBundle\Client\Request', $handler);
    }

}
