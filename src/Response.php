<?php

namespace SpotOption;

use SpotOption\Exceptions\EmailAlreadyExistsException;
use SpotOption\Exceptions\NoPermissionsException;
use SpotOption\Exceptions\NoResultsException;
use SpotOption\Exceptions\NotWhitelistedIpException;

class Response
{
    /**
     * @var \SpotOption\Payload
     */
    protected $payload;

    const FIELD_CONNECTION_STATUS = 'connection_status';

    const FIELD_OPERATION_STATUS = 'operation_status';

    const FIELD_ERRORS = 'errors';

    const STATUS_FAILED = 'failed';

    const ERROR_NO_PERMISSIONS = 'noPermissions';

    const ERROR_COULD_NOT_VALIDATE_IP = 'couldNotValidateIP';

    const ERROR_EMAIL_ALREADY_EXISTS = 'emailAlreadyExists';

    const ERROR_NO_RESULTS = 'noResults';

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
        if (!isset($data[self::FIELD_OPERATION_STATUS]) || $data[self::FIELD_OPERATION_STATUS] == self::STATUS_FAILED) {

            $errors = isset($data[self::FIELD_ERRORS]) ? $data[self::FIELD_ERRORS] : [];

            if (empty($errors)) {
                throw new ServerException($this, "Unknown SpotOption response.");
            }

            foreach ($errors as $error) {
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

        if (is_array($error)) {
            if (isset($error['message'])) {
                $error = $error['message'];
            } else {
                foreach ($error as $errorMessage) {
                    $this->processError($errorMessage);
                }
            }
        }

        switch (strtolower($error)) {
            case strtolower(self::ERROR_NO_RESULTS): {
                throw new NoResultsException($this, "No results");
            }
            case strtolower(self::ERROR_COULD_NOT_VALIDATE_IP): {
                throw new NotWhitelistedIpException($this, "Not whitelisted IP");
            }
            case strtolower(self::ERROR_EMAIL_ALREADY_EXISTS): {
                throw new EmailAlreadyExistsException($this, "Email already exists");
            }
            case strtolower(self::ERROR_NO_PERMISSIONS): {
                throw new NoPermissionsException($this, "No permissions");
            }
            default: {
                throw new ServerException($this, "Unknown SpotOption error. " . print_r($error, 1));
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

    public function getPayload()
    {
        return $this->payload;
    }
}
