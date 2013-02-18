<?php

/**
 * Test the ConnectionTest
 */

namespace Manhattan\LogBundle\Tests\Log;

use Manhattan\LogBundle\Log\Connection;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $mock_buzz = $this->getMock('Buzz\Browser');
        $mock_site = $this->getMockBuilder('Manhattan\LogBundle\Log\Site')
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new Connection($mock_buzz, $mock_site);
        $this->assertInstanceOf('Manhattan\LogBundle\Log\Connection', $handler);
    }

}