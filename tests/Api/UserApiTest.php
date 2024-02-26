<?php

namespace Api;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Exceptions\HttpResourceNotFoundException;
use GeorgiosReklos\Reqres\Http\GuzzleClient;
use GeorgiosReklos\Reqres\Http\Response;
use PHPUnit\Framework\TestCase;

class UserApiTest extends TestCase
{

    public function testThrowsExceptionWhenUserNotFound()
    {
        $this->expectException(HttpResourceNotFoundException::class);

        /** @var GuzzleClient $httpClientMock */
        $httpClientMock = $this->createMock(GuzzleClient::class);
        $httpClientMock->method('request')->willThrowException(
                new HttpResourceNotFoundException('Resource not found')
            );

        $userApi = new UserApi($httpClientMock);
        $userApi->getUser(1);
    }

    public function testGetSingleUser(): void
    {
        $userToTest = [
            'id' => 1,
            'email' => 'foo@bar',
        ];
        $httpClientMock = $this->getHttpClientMock(
            new Response(200, json_encode(['data' => $userToTest]), [])
        );
        $userApi = new UserApi($httpClientMock);
        $user = $userApi->getUser(1);
        $this->assertEquals($userToTest, $user);
    }

    protected function getHttpClientMock(Response $response): GuzzleClient
    {
        /** @var GuzzleClient $httpClientMock */
        $httpClientMock = $this->createMock(GuzzleClient::class);
        $httpClientMock->method('request')->willReturn($response);

        return $httpClientMock;
    }

    public function testGetListUsers(): void
    {
        $usersToTest = [
            [
                'id' => 1,
                'email' => 'foo@bar',
            ],
            [
                'id' => 2,
                'email' => 'foo-bar@baz',
            ],
        ];

        $httpClientMock = $this->getHttpClientMock(
            new Response(200, json_encode(['data' => $usersToTest]), [])
        );
        $userApi = new UserApi($httpClientMock);
        $users = $userApi->getUsers();
        $this->assertEquals(['data' => $usersToTest], $users);
    }

    public function testCreateUser(): void
    {
        $userToTest = [
            'id' => 1,
            'email' => 'foo@bar',
        ];

        $httpClientMock = $this->getHttpClientMock(
            new Response(200, json_encode($userToTest), [])
        );
        $userApi = new UserApi($httpClientMock);
        $userData = $userApi->createUser('johndoe', 'leader');
        $this->assertEquals($userToTest, $userData);
    }
}