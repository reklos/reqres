<?php

namespace GeorgiosReklos\Reqres\Http;

use function json_decode;

class Response
{

    protected ?array $headers;

    protected ?string $content;

    protected int $statusCode;

    public function __construct(
        int $statusCode,
        ?string $content,
        ?array $headers = []
    ) {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
    }

    public function getContent()
    {
        return json_decode($this->content, true);
    }

    public function __toString(): string
    {
        return '[Response] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}