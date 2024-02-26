<?php

namespace GeorgiosReklos\Reqres\Http;

use Exception;
use GeorgiosReklos\Reqres\Exceptions\HttpException;
use GeorgiosReklos\Reqres\Exceptions\HttpResourceNotFoundException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleClient implements Client
{

    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $data
     *
     * @return Response
     * @throws HttpException|HttpResourceNotFoundException
     */
    public function request(
        string $method,
        string $url,
        array $data = []
    ): Response {
        try {
            $response = $this->client->request($method, $url, $data);
        } catch (BadResponseException $e) {
            throw match ($e->getResponse()->getStatusCode()) {
                404 => new HttpResourceNotFoundException('Resource not found'),
                default => new HttpException($e->getMessage()),
            };
        } catch (GuzzleException|Exception $e) {
            throw new HttpException(
                message: 'Unable to complete the HTTP request',
                code: 0,
                previous: $e
            );
        }

        return new Response(
            statusCode: $response->getStatusCode(),
            content: (string)$response->getBody(),
            headers: $response->getHeaders()
        );
    }
}