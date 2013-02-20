<?php

/**
 * Test the LoggerXmlData
 */

namespace Manhattan\LogBundle\Tests\Data;

use Manhattan\LogBundle\Data\LoggerXmlData;

class AtomLoggerXmlDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Manhattan\LogBundle\Handler\CatchErrorHandler::__construct
     */
    public function testConstruct()
    {
        $xml_data = new LoggerXmlData(array('foo' => array(
            'bar' => 'foo')
        ));
        $this->assertInstanceOf('Manhattan\LogBundle\Data\LoggerXmlData', $xml_data);
    }

    public function testSingleRootNodeException()
    {
        $xml_data = new LoggerXmlData(array('foo' => 'bar', 'bar' => 'foo'));

        $this->setExpectedException('Restful\Exception\DataException');
        $xml_data->validate();
    }

    public function testSingleGetNodeVariable()
    {
        $xml_data = new LoggerXmlData(array('foo' => 'bar'));

        $this->setExpectedException('InvalidArgumentException');
        $xml_data->validate();
    }

    public function testNonMatchingArray()
    {
        $xml_data = new LoggerXmlData(array('foo' => array(
            'foo' => 'bar'
        )));

        $this->setExpectedException('Restful\Exception\DataException');
        $xml_data->validate();
    }

    public function testValidation()
    {
        $xml_data = new LoggerXmlData(array('foo' => array(
            'Message' => 'bar'
        )));

        $this->assertTrue($xml_data->validate(), 'Provided data is validated as true and correct.');
    }
}
