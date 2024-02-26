<?php

namespace GeorgiosReklos\Reqres\Tests\Service;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Exceptions\HttpResponseMissingDataException;
use GeorgiosReklos\Reqres\Service\UserPaginationService;
use PHPUnit\Framework\TestCase;

class UserPaginationServiceTest extends TestCase
{

    public function testThrowsExceptionWhenDataIsMissingInApiResponse(): void
    {
        $this->expectException(HttpResponseMissingDataException::class);

        /** @var UserApi $userApiMock */
        $userApiMock = $this->createMock(UserApi::class);
        $userApiMock->method('getUsers')->willReturn([]);
        $userPaginationService = new UserPaginationService($userApiMock);
        $userPaginationService->getUsers();
    }


    /**
     * @dataProvider userDataProvider
     */
    public function testUserPagination(array $usersData): void
    {
        /** @var UserApi $userApiMock */
        $userApiMock = $this->createMock(UserApi::class);
        $userApiMock->method('getUsers')->willReturn($usersData);

        $userPaginationService = new UserPaginationService($userApiMock);
        $usersDto = $userPaginationService->getUsers();
        $this->assertCount(2, $usersDto);
    }

    public function userDataProvider(): array
    {
        return [
            [
                'userData' => [
                    'page' => 1,
                    'per_page' => 2,
                    'total_pages' => 2,
                    'data' => [
                        [
                            'first_name' => 'John',
                            'last_name' => 'Doe',
                        ],
                        [
                            'first_name' => 'John',
                            'last_name' => 'Smith',
                        ],
                    ],
                ],
            ],
            [
                'userData' => [
                    'page' => 2,
                    'per_page' => 2,
                    'total_pages' => 2,
                    'data' => [
                        [
                            'first_name' => 'Joe',
                            'last_name' => 'Bloggs',
                        ],
                        [
                            'first_name' => 'Jane',
                            'last_name' => 'Smith',
                        ],
                    ],
                ],
            ],
        ];
    }

}