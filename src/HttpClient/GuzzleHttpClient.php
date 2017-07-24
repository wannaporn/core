<?php

namespace LineMob\Core;

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Client\HttpClient;
use LINE\LINEBot\HTTPClient as HttpClientInterface;
use LINE\LINEBot\Response;

class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct($channelToken, array $config = [])
    {
        $this->httpClient = GuzzleAdapter::createWithConfig(array_replace_recursive([
            'User-Agent' => 'LINEMOB-PHP/'.Constants::VERSION,
            'Authorization' => 'Bearer '.$channelToken,
            'verify' => true,
        ], $config));
    }

    /**
     * {@inheritdoc}
     */
    public function get($url)
    {
        return $this->doRequest('POST', [], []);
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, array $data)
    {
        return $this->doRequest('POST', ['Content-Type: application/json; charset=utf-8'], $data);
    }

    /**
     * @param $method
     * @param $url
     * @param array $headers
     * @param array $data
     *
     * @return Response
     */
    private function doRequest($method, $url, array $headers = [], array $data = [])
    {
        $request = new Request($method, $url, $headers, $data);
        $response = $this->httpClient->sendRequest($request);

        return new Response(
            $response->getStatusCode(),
            $response->getBody()->getContents(),
            $response->getHeaders()
        );
    }
}
