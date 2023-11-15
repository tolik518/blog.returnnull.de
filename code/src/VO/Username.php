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
            throw new \InvalidArgumentException("Invalid Name: The name is too long");
        }

        if ((strlen($name) < 3))
        {
            throw new \InvalidArgumentException("Invalid Name: The name is too short");
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