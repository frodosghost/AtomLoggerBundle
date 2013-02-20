<?php

/**
 * Test the ConnectionTest
 */

namespace Manhattan\LogBundle\Tests\Client;

use Manhattan\LogBundle\Client\Connection;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $mock_buzz = $this->getMock('Buzz\Browser');
        $mock_configuration = $this->getMockBuilder('Manhattan\LogBundle\Log\Configuration')
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new Connection($mock_buzz, $mock_configuration);
        $this->assertInstanceOf('Manhattan\LogBundle\Client\Connection', $handler);
    }

}
