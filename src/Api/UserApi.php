<?php

namespace GeorgiosReklos\Reqres\Api;

use GeorgiosReklos\Reqres\Exceptions\HttpException;
use GeorgiosReklos\Reqres\Exceptions\HttpResourceNotFoundException;
use GeorgiosReklos\Reqres\Http\ClientInterface as HttpClient;
use GeorgiosReklos\Reqres\Http\ReqresClient;
use GuzzleHttp\Client;

class UserApi
{

    protected string $baseUri = 'https://reqres.in/api';

    protected HttpClient $httpClient;

    public function __construct(
        HttpClient $httpClient = null
    ) {
        if ($httpClient) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new ReqresClient(
                new Client()
            );
        }
    }

    /**
     * @param int $userId
     *
     * @return array
     * @throws HttpException|HttpResourceNotFoundException
     */
    public function getUser(int $userId): array
    {
        $response = $this->httpClient->request(
            'GET',
            "{$this->baseUri}/users/{$userId}"
        );
        $contents = $response->getContent();
        return $contents['data'];
    }

    /**
     * @param int $page
     *
     * @return array
     * @throws HttpException|HttpResourceNotFoundException
     */
    public function getUsers(int $page = 1): array
    {
        $response = $this->httpClient->request(
            'GET',
            "{$this->baseUri}/users?page={$page}"
        );
        return $response->getContent();
    }

    /**
     * @param string $name
     * @param string $job
     *
     * @return array
     * @throws HttpException|HttpResourceNotFoundException
     */
    public function createUser(string $name, string $job): array
    {
        $response = $this->httpClient->request(
            'POST',
            "{$this->baseUri}/users",
            [
                'json' => [
                    'name' => $name,
                    'job' => $job,
                ],
            ]
        );

        return $response->getContent();
    }
}