<?php

namespace SpotOption\Tests;

use GuzzleHttp\Psr7\Response;

class ErrorsTest extends TestCase
{
    /**
     * @expectedException \SpotOption\Exceptions\NoPermissionsException
     */
    public function testSuccessfulAddResponse()
    {
        $apiResponse = new Response(200, [], Stubs::errorNoPermissions());
        $this->mockResponse($apiResponse);
        $this->apiClient->getCampaigns();
    }
}
