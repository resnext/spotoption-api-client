<?php

namespace SpotOption\Tests;

use GuzzleHttp\Psr7\Response;
use SpotOption\Entities\Country;

class CountryModuleTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $apiResponse = new Response(200, [], Stubs::successfulCountryView());

        $this->mockResponse($apiResponse);

        $response = $this->apiClient->getCountries();

        $countries = $response->getData();

        $this->assertGreaterThan(1, count($countries), "Countries array should not be empty.");

        foreach ($countries as $country) {

            if ($country->getIsoAlpha2() == 'US') {
                $this->assertFalse($country->getIsRegistrationAllowed());
            }

            if ($country->getIsoAlpha2() == 'VN') {
                $this->assertTrue($country->getIsRegistrationAllowed());
            }

            $this->assertTrue($country instanceof Country, 'Each country should be correct object of class ' . Country::class);
            $this->assertGreaterThan(0, $country->getId());
            $this->assertEquals(2, strlen($country->getIsoAlpha2()));
        }

        $this->assertTrue(true);
    }
}
