<?php

namespace Returnnull;

class Response
{
    public function __construct(
        private string $body,
        private int $statusCode = 200,
        private array $headers = []
    ) {
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->body;
    }
}
