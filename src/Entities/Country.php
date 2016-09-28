<?php

namespace SpotOption\Entities;

class Country
{
    public function __construct($id, $isoAlpha2)
    {
        $this->id = $id;
        $this->isoAlpha2 = $isoAlpha2;
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

    protected $id;

    protected $isoAlpha2;
}
