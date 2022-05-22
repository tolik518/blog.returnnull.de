<?php

namespace Returnnull;

class ID
{
    private string $id;
    private function __construct($id)
    {
        $this->id = $this->validate($id);
    }

    private function validate($id) : int
    {
        if (is_numeric($id)){
            return (int)$id;
        }
            else
        {
            throw new \InvalidArgumentException('ID scheint ungültig zu sein');
        }
    }

    public function __toString() : string
    {
        return $this->id;
    }

    public static function fromString($id)
    {
        return new ID($id);
    }
}