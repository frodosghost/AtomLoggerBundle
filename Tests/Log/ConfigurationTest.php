<?php

/**
 * Test the SiteTest
 */

namespace Atom\LoggerBundle\Tests\Log;

use Atom\LoggerBundle\Log\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Atom\LoggerBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new Configuration('foo', 'bar');
        $this->assertInstanceOf('Atom\LoggerBundle\Log\Configuration', $handler);

        $this->assertEquals('foo', $handler->getApiKey());
        $this->assertEquals('bar', $handler->getUri());
    }

    public function testConstructionPHPError()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $handler = new Configuration();
    }

    public function testConstructionPHPErrorWithFirstVariable()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $handler = new Configuration('foo');
    }
}
