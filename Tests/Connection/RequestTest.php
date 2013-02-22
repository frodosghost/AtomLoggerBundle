<?php

/**
 * Test the Request
 */

namespace Atom\LoggerBundle\Tests\Connection;

use Atom\LoggerBundle\Connection\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    private $mock_formatter;

    private $mock_data;

    public function setUp()
    {
        $this->mock_formatter = $this->getMock('Restful\Formatter\XmlFormatter');
        $this->mock_data = $this->getMock('Atom\LoggerBundle\Data\AtomLoggerXmlData');
    }
    /**
     * @covers Atom\LoggerBundle\Connection\Request::__construct
     */
    public function testConstruct()
    {
        $request = new Request($this->mock_formatter, $this->mock_data);

        $this->assertInstanceOf('Atom\LoggerBundle\Connection\Request', $request);
    }

    public function testFormatDataException()
    {
        $this->mock_formatter->expects($this->any())
             ->method('format')
             ->will($this->throwException(new \Restful\Exception\DataException));

        $request = new Request($this->mock_formatter, $this->mock_data);

        $this->setExpectedException('Atom\LoggerBundle\Exception\FormattingException');
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
