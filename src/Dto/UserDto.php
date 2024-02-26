<?php

namespace GeorgiosReklos\Reqres\Dto;

use JsonSerializable;

class UserDto implements JsonSerializable
{

    protected ?int $id;

    protected ?string $email;

    protected ?string $firstName;

    protected ?string $lastName;

    protected ?string $avatar;

    public function __construct(array $userData)
    {
        $this->id = $userData['id'] ?? null;
        $this->email = $userData['email'] ?? null;
        $this->firstName = $userData['first_name'] ?? null;
        $this->lastName = $userData['last_name'] ?? null;
        $this->avatar = $userData['avatar'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'avatar' => $this->avatar,
        ];
    }
}