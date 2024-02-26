<?php

namespace GeorgiosReklos\Reqres\Service;

use GeorgiosReklos\Reqres\Api\UserApi;
use GeorgiosReklos\Reqres\Dto\UserDto;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

class UserPaginationService
{

    protected UserApi $userApi;

    protected array $users;

    protected int $currentPage;

    protected int $totalPages;

    public function __construct(
        UserApi $userApi
    ) {
        $this->userApi = $userApi;
        $this->currentPage = 1;
    }

    public function nextPage(): bool
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            return true;
        }
        return false;
    }

    public function previousPage(): bool
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            return true;
        }
        return false;
    }

    public function firstPage(): void
    {
        $this->currentPage = 1;
    }

    public function lastPage(): void
    {
        $this->currentPage = $this->totalPages;
    }

    /**
     * @return UserDto[]
     * @throws ReqresException
     */
    public function getUsers(): array
    {
        $this->users = [];
        $userData = $this->userApi->getUsers($this->currentPage);

        $this->totalPages = $userData['total_pages'];
        foreach ($userData['data'] as $userData) {
            $this->users[] = new UserDto($userData);
        }
        return $this->users;
    }
}