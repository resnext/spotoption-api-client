<?php

namespace SpotOption\Tests;

use GuzzleHttp\Psr7\Response;
use SpotOption\Requests\AddCustomerRequest;

class CustomerModuleTest extends TestCase
{
    public function testSuccessfulAddResponse()
    {
        $apiResponse = new Response(200, [], Stubs::successfulCustomerAdd());

        $this->mockResponse($apiResponse);

        $request = new AddCustomerRequest();

        $response = $this->apiClient->addCustomer($request);

        $this->assertGreaterThan(0, $response->getId(), 'Customer ID should be greater than 0');
        $this->assertGreaterThan(0, strlen($response->getAuthKey()), 'Auth key should be non-empty string');
    }

    /**
     * @expectedException \SpotOption\Exceptions\EmailAlreadyExistsException
     */
    public function testFailedAddResponse_EmailAlreadyExists()
    {
        $apiResponse = new Response(200, [], Stubs::failedCustomerAdd_EmailAlreadyExists());
        $this->mockResponse($apiResponse);
        $request = new AddCustomerRequest();
        $this->apiClient->addCustomer($request);
    }
}
