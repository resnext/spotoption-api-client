<?php

namespace SpotOption\Responses;

use SpotOption\Response;

class AddCustomerResponse extends Response
{
    const DATA_FIELD = 'Customer';

    const FIELD_ID = 'id';

    protected function init()
    {
        parent::init();

        $data = $this->payload->getData();

        var_dump($data);die;
    }
}
