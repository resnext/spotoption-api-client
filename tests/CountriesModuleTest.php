<?php

namespace SpotOption\Tests;

use GuzzleHttp\Psr7\Response;
use SpotOption\Entities\Country;

class CountriesModuleTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $response = new Response(200, [], Stubs::successfulCountriesView());

        $this->mockResponse($response);

        $result = $this->apiClient->getCountries();

        $countries = $result->getData();

        $this->assertGreaterThan(1, count($countries), "Countries array should not be empty.");

        foreach ($countries as $country) {
            $this->assertTrue($country instanceof Country, 'Each country should be correct object of class ' . Country::class);
            $this->assertGreaterThan(0, $country->getId());
            $this->assertEquals(2, strlen($country->getIsoAlpha2()));
        }

        $this->assertTrue(true);
    }
}
