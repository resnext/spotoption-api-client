<?php

namespace SpotOption;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp;
use SpotOption\Responses\GetCountriesResponse;

class ApiClient implements LoggerAwareInterface
{
    protected $url;

    protected $username;

    protected $password;

    /**
     * @var \GuzzleHttp\ClientInterface A Guzzle HTTP client.
     */
    protected $httpClient;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger = null;

    /**
     * ApiClient constructor.
     *
     * @param string $url Solaris API endpoint.
     * @param string $username
     * @param string $password
     * @param mixed  $options
     */
    public function __construct($url, $username, $password, $options = [])
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;

        if (isset($options['httpClient']) && $options['httpClient'] instanceof GuzzleHttp\ClientInterface) {
            $this->httpClient = $options['httpClient'];
        }
    }


    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getCountries()
    {
        $data = [
            'MODULE'        => 'Countries',
            'COMMAND'       => 'view',
        ];
        $payload = new Payload($this->request($data));
        return new GetCountriesResponse($payload);
    }

    /**
     * Adds API credentials to request data
     *
     * @param $data
     */
    protected function sign(&$data)
    {
        $data['api_username'] = $this->username;
        $data['api_password'] = $this->password;
    }

    /**
     * Sends request to Solaris API endpoint.
     *
     * @param array  $data
     *
     * @return string
     */
    protected function request($data = [])
    {
        $url = rtrim($this->url, '?');
        $this->sign($data);
        try {
            return (string) $this->getHttpClient()->post($url, [
                GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
                GuzzleHttp\RequestOptions::HEADERS => [
                    'User-Agent' => 'ResNext / SpotOption API Client',
                ]
            ])->getBody();
        } catch (GuzzleHttp\Exception\ConnectException $e) {
            return new ClientException($e->getMessage());
        } catch (GuzzleHttp\Exception\ClientException $e) {
            return (string) $e->getResponse()->getBody();
        } catch (GuzzleHttp\Exception\ServerException $e) {
            return (string) $e->getResponse()->getBody();
        }
    }


    /**
     * This method should be used instead direct access to property $httpClient
     *
     * @return \GuzzleHttp\ClientInterface|GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (!is_null($this->httpClient)) {
            return $this->httpClient;
        }
        $stack = GuzzleHttp\HandlerStack::create();
        if ($this->logger instanceof LoggerInterface) {
            $stack->push(GuzzleHttp\Middleware::log(
                $this->logger,
                new GuzzleHttp\MessageFormatter(GuzzleHttp\MessageFormatter::DEBUG)
            ));
        }
        $this->httpClient = new GuzzleHttp\Client([
            'handler' => $stack,
        ]);
        return $this->httpClient;
    }
}
