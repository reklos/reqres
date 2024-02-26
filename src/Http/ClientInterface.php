<?php

namespace GeorgiosReklos\Reqres\Http;

interface ClientInterface
{

    public function request(
        string $method,
        string $url,
        array $data = []
    ): Response;
}