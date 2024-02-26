<?php

namespace GeorgiosReklos\Reqres\Tests\Service;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Dto\UserDto;
use GeorgiosReklos\Reqres\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{

    public function testGetSingleUser()
    {
        $userToTest = [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@test.com',
            'avatar' => 'foo-bar-avatar',
        ];

        $expectedUserDto = new UserDto($userToTest);

        /** @var UserApi $userApiMock */
        $userApiMock = $this->createMock(UserApi::class);
        $userApiMock->method('getUser')->willReturn($userToTest);

        $user = new UserService($userApiMock);
        $userDto = $user->getUser(1);

        $this->assertInstanceOf(UserDto::class, $userDto);
        $this->assertEquals($expectedUserDto->toArray(), $userDto->toArray());
    }

    public function testGetUsersFromPage()
    {
        $usersToTest = [
            [
                'id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@test.com',
                'avatar' => 'foo-bar-avatar',
            ],
            [
                'id' => 2,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
                'email' => 'peterdoe@test.com',
                'avatar' => 'foo-bar-baz-avatar',
            ],
        ];

        /** @var UserApi $userApiMock */
        $userApiMock = $this->createMock(UserApi::class);
        $userApiMock->method('getUsers')->willReturn(['data' => $usersToTest]);

        $user = new UserService($userApiMock);
        $usersDto = $user->getUsersFromPage(1);

        $this->assertCount(2, $usersDto);
        $this->assertInstanceOf(UserDto::class, $usersDto[0]);
        $this->assertInstanceOf(UserDto::class, $usersDto[1]);
    }
}