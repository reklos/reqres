<?php

namespace GeorgiosReklos\Reqres;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Exceptions\PropertyNotFoundException;
use GeorgiosReklos\Reqres\Service\UserPaginationService;
use GeorgiosReklos\Reqres\Service\UserService;

/**
 * @property UserService           $user
 * @property UserPaginationService $userPagination
 */
class Client
{

    protected UserService $user;

    protected UserPaginationService $userPagination;

    public function __construct()
    {
        if (!isset($this->user)) {
            $this->user = new UserService(
                new UserApi()
            );
        }

        if (!isset($this->userPagination)) {
            $this->userPagination = new UserPaginationService(
                new UserApi()
            );
        }
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws PropertyNotFoundException
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new PropertyNotFoundException("Property {$name} not found");
    }
}