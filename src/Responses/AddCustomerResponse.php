<?php

namespace SpotOption\Responses;

use SpotOption\Response;

class AddCustomerResponse extends Response
{
    const DATA_FIELD = 'Customer';

    const FIELD_ID = 'id';

    const FIELD_AUTH_KEY = 'authKey';

    /**
     * Returns Customer ID (ID of created customer in SpotOption platform)
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns auth key
     *
     * @return string
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $authKey;

    protected function init()
    {
        parent::init();
        $data = $this->payload->getData();
        $this->id = $data[self::DATA_FIELD][self::FIELD_ID];
        $this->authKey = isset($data[self::DATA_FIELD][self::FIELD_AUTH_KEY]) ? $data[self::DATA_FIELD][self::FIELD_AUTH_KEY] : null;
    }
}
