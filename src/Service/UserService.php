<?php

namespace GeorgiosReklos\Reqres\Service;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Dto\UserDto;
use GeorgiosReklos\Reqres\Exceptions\HttpResponseMissingDataException;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

class UserService
{

    public function __construct(
        protected readonly UserApi $userApi
    ) {
    }

    /**
     * @param int $userId
     *
     * @return UserDto|null
     * @throws ReqresException
     */
    public function getUser(int $userId): ?UserDto
    {
        $userData = $this->userApi->getUser($userId);
        return $userData ? new UserDto($userData) : null;
    }

    /**
     * @param int $page
     *
     * @return UserDto[]
     * @throws ReqresException
     */
    public function getUsersFromPage(int $page = 1): array
    {
        $usersData = $this->userApi->getUsers($page);

        if (!isset($usersData['data'])) {
            throw new HttpResponseMissingDataException(
                'Data key is missing in API response'
            );
        }

        $users = [];
        foreach ($usersData['data'] as $userData) {
            $users[] = new UserDto($userData);
        }
        return $users;
    }

    /**
     * @param string $name
     * @param string $job
     *
     * @return int UserId
     * @throws ReqresException
     */
    public function createUser(string $name, string $job): int
    {
        $userData = $this->userApi->createUser($name, $job);
        return $userData['id'];
    }
}