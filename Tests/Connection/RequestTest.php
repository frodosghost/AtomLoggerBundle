<?php

/**
 * Test the Request
 */

namespace Manhattan\LogBundle\Tests\Connection;

use Manhattan\LogBundle\Connection\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    private $mock_formatter;

    private $mock_data;

    public function setUp()
    {
        $this->mock_formatter = $this->getMock('Restful\Formatter\XmlFormatter');
        $this->mock_data = $this->getMock('Manhattan\LogBundle\Data\AtomLoggerXmlData');
    }
    /**
     * @covers Manhattan\LogBundle\Connection\Request::__construct
     */
    public function testConstruct()
    {
        $request = new Request($this->mock_formatter, $this->mock_data);

        $this->assertInstanceOf('Manhattan\LogBundle\Connection\Request', $request);
    }

    public function testFormatDataException()
    {
        $this->mock_formatter->expects($this->any())
             ->method('format')
             ->will($this->throwException(new \Restful\Exception\DataException));

        $request = new Request($this->mock_formatter, $this->mock_data);

        $this->setExpectedException('Manhattan\LogBundle\Exception\ConfigurationException');
        $request->formatData();
    }

    public function testFormatData()
    {
        $this->mock_formatter->expects($this->any())
             ->method('format')
             ->will($this->returnValue('<foo></foo>'));

        $request = new Request($this->mock_formatter, $this->mock_data);

        $this->assertEquals('<foo></foo>', $request->formatData());
    }
}
