<?php

namespace Ducnm\Infrastructure\Helpers;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ApiHelpers
{
    public static function curlCafeF($url, $param = null): array
    {
        try {
            $response = $param ? Http::get($url, $param) : Http::get($url);

            $response->throw();

            $data = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        } catch (HttpClientException $httpClientException) {
            throw new RuntimeException('API Error: ' . $httpClientException->getMessage(), $httpClientException->getCode(), $httpClientException);
        }

        return $data;
    }

    public static function curlDnse(string $url, $method, $param = [], $data = []): array
    {
        $result = [];

        try {
            $header = Http::withHeaders($result);

            $response = !empty($method) && $method === 'POST' ? $header->post($url, $data) : $header->get($url, $param);

            $response->throw();

            $data = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        } catch (HttpClientException $httpClientException) {
            throw new RuntimeException('API Error: ' . $httpClientException->getMessage(), $httpClientException->getCode(), $httpClientException);
        }

        return $data;
    }
}
