<?php


namespace Manhattan\LogBundle\Connection;

use Restful\Formatter\XmlFormatter;
use Manhattan\LogBundle\Connection\Client;
use Manhattan\LogBundle\Data\AtomLoggerXmlData;

use Restful\Exception\DataException;
use Manhattan\LogBundle\Exception\ConfigurationException;

/**
 * Setup the Request for sending to AtomLogger
 *
 * @author James Rickard <james@frodosghost.com>
 */
class Request
{

    /**
     * @var Restful\Formatter\XmlFormatter
     */
    private $formatter;

    /**
     * @var Restful\Data\AbstractData
     */
    private $data;

    public function __construct(XmlFormatter $formatter, AtomLoggerXmlData $data)
    {
        $this->formatter = $formatter;
        $this->data = $data;
    }

    public function setData(array $data)
    {
        $this->data->append(array('root-node' => $data));

        return $this;
    }

    /**
     * Calls the Formatter with the data passed into the Request
     * 
     * @return string
     */
    public function formatData()
    {
        $this->formatter->addData($this->data);

        try {
            $formatted = $this->formatter->format();
        } catch (DataException $e) {
            throw new ConfigurationException('The provided data has been incorrectly formatted.');
        }

        return $formatted;
    }

}
