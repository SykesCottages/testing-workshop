<?php

namespace SykesCottages\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Client\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

abstract class RequestTestCase extends TestCase
{
    private Client $httpClient;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->httpClient = new Client(['']);
    }

    /**
     * @param string $method
     * @param string $controller
     * @param array $query
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function request(
        string $method,
        string $controller,
        array $query,
        array $data = []
    ): ResponseInterface {
        $query = array_merge(['controller' => $controller], $query);
        $queryStringParts = [];
        foreach($query as $key => $value) {
            $queryStringParts []= $key . '=' . $value;
        }
        return $this->httpClient->request(
            $method,
            "http://www/?" . implode('&', $queryStringParts),
            [
                'http_errors' => false,
                'form_params' => $data
            ]
        );
    }
}
