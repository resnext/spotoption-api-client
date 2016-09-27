<?php

namespace SpotOption;

class Response
{
    protected $payload;

    const FIELD_CONNECTION_STATUS = 'connection_status';

    const FIELD_OPERATION_STATUS = 'operation_status';

    const FIELD_ERRORS = 'errors';

    const STATUS_FAILED = 'failed';

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
            }

            throw new ServerException($this, "SpotOption operation failed.");
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
