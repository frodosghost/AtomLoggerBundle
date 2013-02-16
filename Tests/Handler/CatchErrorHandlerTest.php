<?php

/**
 * Test the CatchErrorHandler
 */

namespace Manhattan\LogBundle\Tests\Handler;

use Symfony\Bundle\MonologBundle\Tests\TestCase;
use Monolog\Logger;
use Manhattan\LogBundle\Handler\CatchErrorHandler;

class CatchErrorHandlerTest extends TestCase
{
    /*public function setUp()
    {
        if (!class_exists("Raven_Client")) {
            $this->markTestSkipped("raven/raven not installed");
        }

        require_once __DIR__ . '/MockRavenClient.php';
    }*/

    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $mock_connection = $this->getMockBuilder('Manhattan\LogBundle\Client\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new CatchErrorHandler($mock_connection);
        $this->assertInstanceOf('Manhattan\LogBundle\Handler\CatchErrorHandler', $handler);
    }

}
