<?php

namespace SpotOption;

/**
 * Stores incoming or outgoing message data for an SpotOption API call.
 */
class Payload implements \ArrayAccess, \JsonSerializable
{
    /**
     * @var array The response data.
     */
    protected $data;

    protected $rawData = null;

    /**
     * Creates a new payload object from string.
     *
     * @param string $xml The payload data.
     */
    public function __construct($xml)
    {
        $this->rawData = $xml;

        $data = @simplexml_load_string($xml);

        if ($data === false) {
            throw new \UnexpectedValueException('Invalid XML message.');
        }

        $this->data = $this->xml2array($data);
    }

    /**
     * function xml2array
     *
     * This function is part of the PHP manual.
     *
     * The PHP manual text and comments are covered by the Creative Commons
     * Attribution 3.0 License, copyright (c) the PHP Documentation Group
     *
     * @author  k dot antczak at livedata dot pl
     * @date    2011-04-22 06:08 UTC
     * @link    http://www.php.net/manual/en/ref.simplexml.php#103617
     * @license http://www.php.net/license/index.php#doc-lic
     * @license http://creativecommons.org/licenses/by/3.0/
     * @license CC-BY-3.0 <http://spdx.org/licenses/CC-BY-3.0>
     */
    public function xml2array($xmlObject, $out = array ())
    {
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? $this->xml2array ( $node ) : $node;

        return $out;
    }

    /**
     * Gets the payload data.
     *
     * @return array The payload data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Serializes the payload to a JSON message.
     *
     * @return string A JSON message.
     */
    public function toJson()
    {
        return json_encode($this->data, true);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
            return;
        }
        $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    public function getRawData()
    {
        return $this->rawData;
    }
}
