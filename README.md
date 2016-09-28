# SpotOption API Client.
API Client for binary options platform SpotOption.

## Installation

Install using Composer, doubtless.

```sh
$ composer require resnext/spotoption-api-client
```

## General API Client usage.

```php
$apiClient = new SpotOption\ApiClient(<URL>, <USERNAME>, <PASSWORD>);
```

### Error handling

Each method of \SpotOption\ApiClient can return response object (instance of \SpotOption\Response) or
throws two kind of exceptions.

1. \SpotOption\ServerException Server-side exception assigned with invalid data received of impossible operation is requested.
2. \SpotOption\ClientException Client-side exception means API Client cannot connect to SpotOption servers or receive invalid 
response with any reasons.

### Configuration and customization
Your can configure used HTTP client using $options param of ApiClient constructor.

Example:
```php
$httpClient = new GuzzleHttp\Client([
   GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 2,
]);

$apiClient = new \SpotOption\ApiClient(<API_URL>, <API_USERNAME>, <API_PASSWORD>, [
    'httpClient' => $httpClient,
]);
```

## Countries retrieving

```php
/** @var \SpotOption\Response\GetCountriesResponse $response */
$response = $this->apiClient->getCountries();
/** @var \SpotOption\Entities\Country[] $countries */
$countries = $response->getData();
```