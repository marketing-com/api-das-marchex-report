<?php

namespace Marchex;

use GuzzleHttp\Client;

class Request {
    /**
     * A Guzzle HTTP client instance
     * @var GuzzleHttp\Client
     **/
    private $client;

    /**
     * The response received after sending a request
     * @var json
     **/
    private $response;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function send($method, $params = [])
    {
        $this->response = $this->client->request('POST', Marchex::getBaseUrl(), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . Marchex::getCredentials()
            ],
            'json' => [
                'jsonrpc' => '2.0',
                'id' => '1',
                'method' => $method,
                'params' => $params,
            ]
        ]);
    }

    public function getOutput()
    {
        $output = json_decode($this->response->getBody(), true);
        return $output['result'];
    }
}
