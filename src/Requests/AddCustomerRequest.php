<?php

namespace SpotOption\Requests;

use SpotOption\Request;

class AddCustomerRequest extends Request
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getRegistrationCountry()
    {
        return $this->registrationCountry;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @return mixed
     */
    public function getSubCampaign()
    {
        return $this->subCampaign;
    }

    /**
     * @return mixed
     */
    public function getSubCampaignId()
    {
        return $this->subCampaignId;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getReferLink()
    {
        return $this->referLink;
    }

    /**
     * @return mixed
     */
    public function getAAid()
    {
        return $this->aAid;
    }

    /**
     * @return mixed
     */
    public function getABid()
    {
        return $this->aBid;
    }

    /**
     * @return mixed
     */
    public function getACid()
    {
        return $this->aCid;
    }

    /**
     * @return mixed
     */
    public function getRegistrationIpAddress()
    {
        return $this->registrationIpAddress;
    }

    /**
     * If the registrant is compliant with regulation. Can be: ‘none’,’pending’,’suspend’,’approve’
     *
     * @return string
     */
    public function getRegulateStatus()
    {
        return $this->regulateStatus;
    }

    /**
     * The type of regulation
     *
     * @return int
     */
    public function getRegulateType()
    {
        return $this->regulateType;
    }

    protected $firstName;
    protected $lastName;
    protected $gender = 'male';
    protected $email;
    protected $phone;
    protected $country;
    protected $registrationCountry;
    protected $password;
    protected $currency = 'USD';
    protected $campaignId;
    protected $subCampaign;
    protected $subCampaignId;
    protected $birthday = '1970-01-01';
    protected $referLink;
    protected $aAid;
    protected $aBid;
    protected $aCid;
    protected $registrationIpAddress;

    /**
     * If the registrant is compliant with regulation. Can be: ‘none’,’pending’,’suspend’,’approve’
     *
     * @var string
     */
    protected $regulateStatus;

    /**
     * The type of regulation
     *
     * @var int
     */
    protected $regulateType;
}
