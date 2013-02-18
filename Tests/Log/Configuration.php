<?php

/**
 * Test the SiteTest
 */

namespace Manhattan\LogBundle\Tests\Log;

use Manhattan\LogBundle\Log\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new Configuration('foo', 'bar');
        $this->assertInstanceOf('Manhattan\LogBundle\Log\Configuration', $handler);
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
