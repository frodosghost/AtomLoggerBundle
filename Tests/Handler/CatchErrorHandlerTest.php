<?php

/**
 * Test the CatchErrorHandler
 */

namespace Manhattan\Tests\Handler;

use Monolog\TestCase;
use Monolog\Logger;
use Manhattan\Handler\CatchErrorHandler;

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
     * @covers Monolog\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new CatchErrorHandler();
        $this->assertInstanceOf('Manhattan\Handler\CatchErrorHandler', $handler);
    }

}
