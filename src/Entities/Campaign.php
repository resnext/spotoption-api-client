<?php

namespace SpotOption\Entities;

class Campaign
{
    const TYPE_CPA = 'CPA';

    const TYPE_CPL = 'CPL';

    const TYPE_FIX = 'FIX';

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Returns the unique numeric identifier of the campaign
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the provided name of the campaign
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Returns the number of depositing customers registered from the campaign in total
     *
     * @return int
     */
    public function getPlayersNum()
    {
        return $this->playersNum;
    }

    /**
     * Returns the total amount of money deposited by customers registered from the campaign in total
     *
     * @return int
     */
    public function getTotalDeposits()
    {
        return $this->totalDeposits;
    }

    /**
     * The unique numeric identifier of the campaign
     *
     * @var int
     */
    protected $id;

    /**
     * The provided name of the campaign
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $startDate;

    /**
     * @var string
     */
    protected $endDate;

    /**
     * Campaign type (can be: 'CPA', 'CPL' or 'FIX')
     *
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $country;

    /**
     * The number of depositing customers registered from the campaign in total
     *
     * @var int
     */
    protected $playersNum;

    /**
     * The total amount of money deposited by customers registered from the campaign in total
     *
     * @var int
     */
    protected $totalDeposits;


}
