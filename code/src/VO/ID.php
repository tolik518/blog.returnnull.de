<?php

namespace Returnnull;

class ID
{
    private string $id;
    private function __construct($id)
    {
        $this->id = $this->validate($id);
    }

    private function validate($id): int
    {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException('ID seems to be invalid.');
        }

        return (int)$id;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public static function fromString($id): ID
    {
        return new ID($id);
    }
}