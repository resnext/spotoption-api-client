<?php

namespace SpotOption\Responses;

use SpotOption\Entities\Campaign;
use SpotOption\Exceptions\NoResultsException;
use SpotOption\Response;

class GetCampaignsResponse extends Response
{
    const DATA_FIELD = 'Campaign';

    /**
     * @var \SpotOption\Entities\Campaign[]
     */
    protected $campaigns = [];

    protected function init()
    {
        try {
            parent::init();
        } catch (NoResultsException $e) {
            return true;
        }

        $data = $this->payload->getData();

        $campaigns = $data[self::DATA_FIELD];

        foreach ($campaigns as $campaign) {
            $this->campaigns[] = new Campaign($campaign);
        }
    }

    /**
     * Returns campaigns objects.
     *
     * @return \SpotOption\Entities\Campaign[]
     */
    public function getData()
    {
        return $this->campaigns;
    }
}
