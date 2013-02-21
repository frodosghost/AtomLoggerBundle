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
        $mock_formatter = $this->getMock('Restful\Formatter\XmlFormatter');
        $mock_data = $this->getMock('Manhattan\LogBundle\Data\AtomLoggerXmlData');

        $request = new Request($mock_formatter, $mock_data);

        $this->assertInstanceOf('Manhattan\LogBundle\Connection\Request', $request);
    }

    public function testFormatDataException()
    {
        $mock_formatter = $this->getMock('Restful\Formatter\XmlFormatter');
        $mock_data = $this->getMock('Manhattan\LogBundle\Data\AtomLoggerXmlData');

        $mock_formatter->expects($this->any())
             ->method('format')
             ->will($this->throwException(new \Restful\Exception\DataException));

        $request = new Request($mock_formatter, $mock_data);

        $this->setExpectedException('Manhattan\LogBundle\Exception\ConfigurationException');
        $request->formatData();
    }

    public function testFormatData()
    {
        $mock_formatter = $this->getMock('Restful\Formatter\XmlFormatter');
        $mock_data = $this->getMock('Manhattan\LogBundle\Data\AtomLoggerXmlData');

        $mock_formatter->expects($this->any())
             ->method('format')
             ->will($this->returnValue('<foo></foo>'));

        $request = new Request($mock_formatter, $mock_data);

        $this->assertEquals('<foo></foo>', $request->formatData());
    }
}
