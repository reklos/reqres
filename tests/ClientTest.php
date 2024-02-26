<?php

use GeorgiosReklos\Reqres\Client;
use GeorgiosReklos\Reqres\Exceptions\PropertyNotFoundException;
use GeorgiosReklos\Reqres\Service\UserPaginationService;
use GeorgiosReklos\Reqres\Service\UserService;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    public function testThrowsExceptionPropertyServiceNotFound()
    {
        $this->expectException(PropertyNotFoundException::class);
        $client = new Client();
        $client->foo;
    }

    public function testAccessToUserService()
    {
        $client = new Client();
        $this->assertInstanceOf(UserService::class, $client->user);
    }

    public function testAccessToUserPaginationService()
    {
        $client = new Client();
        $this->assertInstanceOf(
            UserPaginationService::class,
            $client->userPagination
        );
    }

}