<?php

namespace Returnnull;

class Username
{
    private string $username;
    private function __construct(string $username)
    {
        $this->username = $this->validate($username);
    }

    private function validate($name): string
    {
        if ((strlen($name) > 45))
        {
            throw new \InvalidArgumentException("Ungültiger Name: Der Name ist zu lang");
        }

        if ((strlen($name) < 3))
        {
            throw new \InvalidArgumentException("Ungültiger Name: Der Name ist zu kurz");
        }

        return htmlspecialchars($name);
    }

    public function __toString(): string
    {
        return $this->username;
    }

    public static function fromString(string $username): Username
    {
        return new Username($username);
    }
}