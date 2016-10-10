<?php

namespace SpotOption\Responses;

use SpotOption\Entities\Country;
use SpotOption\Response;

class GetCountriesResponse extends Response
{
    const DATA_FIELD = 'Country';

    const FIELD_ID = 'id';

    const FIELD_ISO_ALPHA_2 = 'iso';

    const FIELD_REGISTRATION_ALLOWED = 'allowRegistration';

    /**
     * @var \SpotOption\Entities\Country[]
     */
    protected $countries = [];

    protected function init()
    {
        parent::init();

        $data = $this->payload->getData();

        $countries = $data[self::DATA_FIELD];

        foreach ($countries as $country) {
            if (!$isoAlpha2 = static::safeArrayToString($country[self::FIELD_ISO_ALPHA_2])) {
                continue;
            }
            $id = $country[self::FIELD_ID];
            $registrationAllowed = $country[self::FIELD_REGISTRATION_ALLOWED];
            $this->countries[] = new Country($id, $isoAlpha2, $registrationAllowed);
        }
    }

    /**
     * Returns countries objects.
     *
     * @return \SpotOption\Entities\Country[]
     */
    public function getData()
    {
        return $this->countries;
    }
}
