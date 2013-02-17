<?php

/**
 * Test the SiteTest
 */

namespace Manhattan\LogBundle\Tests\Log;

use Manhattan\LogBundle\Log\Site;

class SiteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new Site('foo', 'bar');
        $this->assertInstanceOf('Manhattan\LogBundle\Log\Site', $handler);
    }

    public function testConstructionPHPError()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $handler = new Site();
    }

    public function testConstructionPHPErrorWithFirstVariable()
    {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        $handler = new Site('foo');
    }
}
