<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\HttpClient;

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Client\HttpClient;
use LINE\LINEBot\HTTPClient as HttpClientInterface;
use LINE\LINEBot\Response;
use LineMob\Core\Constants;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct($channelToken, array $config = [])
    {
        $this->httpClient = GuzzleAdapter::createWithConfig(array_replace_recursive([
            'verify' => true,
            'headers' => [
                'User-Agent' => 'LINEMOB-PHP/'.Constants::VERSION,
                'Authorization' => 'Bearer '.$channelToken,
            ]
        ], $config));
    }

    /**
     * {@inheritdoc}
     */
    public function get($url)
    {
        return $this->doRequest('POST', $url, [], []);
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, array $data)
    {
        return $this->doRequest('POST', $url, ['Content-Type' => 'application/json; charset=utf-8'], $data);
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
        $request = new Request($method, $url, $headers, \GuzzleHttp\json_encode($data));
        $response = $this->httpClient->sendRequest($request);

        return new Response(
            $response->getStatusCode(),
            $response->getBody()->getContents(),
            /** @scrutinizer ignore-type */
            $response->getHeaders()
        );
    }
}
