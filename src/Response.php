<?php

namespace SpotOption;

use SpotOption\Exceptions\NotWhitelistedIpException;

class Response
{
    protected $payload;

    const FIELD_CONNECTION_STATUS = 'connection_status';

    const FIELD_OPERATION_STATUS = 'operation_status';

    const FIELD_ERRORS = 'errors';

    const STATUS_FAILED = 'failed';

    const ERROR_COULD_NOT_VALIDATE_IP = 'couldNotValidateIP';

    protected $errors = [];

    final public function __construct(Payload $payload)
    {
        $this->payload = $payload;
        $this->init();
    }

    /**
     * This method called when SpotOptions API response received and successfully parsed. Id does mean that we have a
     * valid data object parsed from XML. In this method we analyse common errors that can be happened with any request.
     *
     * Common errors example: invalid credentials, restricted IP address, access denied, etc...
     */
    protected function init()
    {
        $data = $this->payload->getData();
        // Process failed operation
        if ($data[self::FIELD_OPERATION_STATUS] == self::STATUS_FAILED) {
            foreach ($data[self::FIELD_ERRORS] as $error) {
                $this->errors[] = $error;
                $this->processError($error);
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function processError($error) {
        switch ($error) {
            case self::ERROR_COULD_NOT_VALIDATE_IP: {
                throw new NotWhitelistedIpException($this, "Not whitelisted IP");
            }
            default: {
                throw new ServerException($this, "Unknown SpotOption error. " . $error);
            }
        }
    }

    /**
     * This function is hack for crazy SpotOption responses. Some simple fields can be string or array with single value.
     * For example: ISO code of country can be returned as array. What does it mean? Country can have two codes?
     * But sometimes this field can be returned as string.
     * So, for this cases we need force convert array to string for some fields.
     *
     * @param $data
     *
     * @return string
     */
    protected static function safeArrayToString($data)
    {

        return is_array($data) ? array_shift($data) : $data;
    }
}
