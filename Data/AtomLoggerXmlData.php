<?php

namespace Atom\LoggerBundle\Data;

use Restful\Data\AbstractData;
use Restful\Exception\DataException;

/**
 * This class validates the provided data to be correct for sending
 * to AtomLogger
 * 
 * @author James Rickard <james@frodosghost.com>
 */
class AtomLoggerXmlData extends AbstractData
{
    /**
     * Validate the data to be correct for a request
     */
    public function validate()
    {
        if ($this->count() > 1) {
            throw new DataException('There should be only one root node to configure for Atom Logger data.');
        }

        foreach ($this->getNodes() as $field => $value) {
            // Check for field name exists in the provided data.
            if (!in_array($field, $this->getFields())) {
                throw new DataException("The field \"{$field}\" is provided but is not in the required fields list.");
            }
        }

        return true;
    }

    /**
     * Fields required to be provided to include with the Request Data
     * 
     * @return array
     */
    private function getFields()
    {
        return array(
            'Message'
        );
    }

    /**
     * Accessor to return Root Node
     * 
     * @return string
     */
    private function getRootNode()
    {
        return $this->getIterator()->key();
    }

    /**
     * Accessor to return nodes from Data
     * 
     * @return ArrayIterator
     */
    private function getNodes()
    {
        return $this->getRecursiveIterator()->getChildren();
    }
}
