<?php

namespace SpotOption\Tests;

use GuzzleHttp\Psr7\Response;
use SpotOption\Entities\Campaign;

class CampaignModuleTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $apiResponse = new Response(200, [], Stubs::successfulCampaignView1());

        $this->mockResponse($apiResponse);

        $response = $this->apiClient->getCampaigns();

        $campaigns = $response->getData();

        $this->assertGreaterThan(0, count($campaigns), "Campaigns array should not be empty.");

        $campaign = array_pop($campaigns);

        $this->assertEquals(123, $campaign->getId());
        $this->assertEquals('Campaign name', $campaign->getName());
        $this->assertEquals('CPA', $campaign->getType());
        $this->assertEquals('Any', $campaign->getCountry());
        $this->assertEquals(123456, $campaign->getTotalDeposits());
    }
}
