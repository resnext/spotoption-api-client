<?php

namespace SpotOption\Entities;

class Country
{
    public function __construct($id, $isoAlpha2, $registrationAllowed)
    {
        $this->id = $id;
        $this->isoAlpha2 = $isoAlpha2;
        $this->registrationAllowed = $registrationAllowed;
    }

    /**
     * Returns Country ID from SpotOption platform. This ID must be used for leads creation.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns two-letters ISO code of country in uppercase. Example: 'GB'.
     *
     * @return string
     */
    public function getIsoAlpha2()
    {
        return $this->isoAlpha2;
    }

    public function getIsRegistrationAllowed()
    {
        return (boolean) $this->registrationAllowed;
    }

    protected $id;

    protected $isoAlpha2;

    protected $registrationAllowed = null;
}
