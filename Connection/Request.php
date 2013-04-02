<?php


namespace Atom\LoggerBundle\Connection;

use Restful\Formatter\XmlFormatter;
use Atom\LoggerBundle\Connection\Client;
use Atom\LoggerBundle\Data\AtomLoggerXmlData;

use Restful\Exception\DataException;
use Atom\LoggerBundle\Exception\FormattingException;

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
     * @var Atom\LoggerBundle\Data\AtomLoggerXmlData
     */
    private $data;

    public function __construct(XmlFormatter $formatter, AtomLoggerXmlData $data)
    {
        $this->formatter = $formatter;
        $this->data = $data;
    }

    public function setData(array $data)
    {
        $this->data->append(array('atom-api' => array('error' => $data)));

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
            throw new FormattingException('The provided data has been incorrectly formatted.');
        }

        return $formatted;
    }

    public function getContentType()
    {
        return $this->formatter->getContentType();
    }

}
