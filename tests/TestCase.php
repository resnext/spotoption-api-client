<?php

namespace SpotOption\Tests;

use SpotOption\ApiClient;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \SpotOption\ApiClient
     */
    protected $apiClient;

    /**
     * Sets up a test with some useful objects.
     */
    public function setUp()
    {
    }

    /**
     * Free resources.
     */
    public function tearDown()
    {
    }

    /**
     * This method allows mock responses for SpotOption API.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    protected function mockResponse(Response $response)
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $httpClient = new HttpClient(['handler' => $handler]);
        $this->apiClient = new ApiClient(null, null, null, [
            'httpClient' => $httpClient,
        ]);
    }
}
