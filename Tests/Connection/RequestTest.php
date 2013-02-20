<?php

/**
 * Test the Request
 */

namespace Manhattan\LogBundle\Tests\Connection;

use Manhattan\LogBundle\Connection\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Connection\Request::__construct
     */
    public function testConstruct()
    {
        $mock_client = $this->getMockBuilder('Manhattan\LogBundle\Connection\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new Request($mock_client);
        $this->assertInstanceOf('Manhattan\LogBundle\Connection\Request', $handler);
    }

}
