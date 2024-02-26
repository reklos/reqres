<?php

namespace GeorgiosReklos\Reqres\Tests\Service;

use GeorgiosReklos\Reqres\Exceptions\PropertyNotFoundException;
use GeorgiosReklos\Reqres\Service\ClientService;
use GeorgiosReklos\Reqres\Service\UserPaginationService;
use GeorgiosReklos\Reqres\Service\UserService;
use PHPUnit\Framework\TestCase;

class ClientServiceTest extends TestCase
{

    public function testThrowsExceptionPropertyServiceNotFound(): void
    {
        $this->expectException(PropertyNotFoundException::class);
        $client = new ClientService();
        $client->foo;
    }

    public function testAccessToUserService(): void
    {
        $client = new ClientService();
        $this->assertInstanceOf(UserService::class, $client->user);
    }

    public function testAccessToUserPaginationService(): void
    {
        $client = new ClientService();
        $this->assertInstanceOf(
            UserPaginationService::class,
            $client->userPagination
        );
    }

}