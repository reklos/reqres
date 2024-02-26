<?php

namespace GeorgiosReklos\Reqres\Http;

interface Client
{

    public function request(
        string $method,
        string $url,
        array $data = []
    ): Response;
}