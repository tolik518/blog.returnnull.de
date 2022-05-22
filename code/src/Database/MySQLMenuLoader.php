<?php

namespace Returnnull;

class MySQLMenuLoader
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function get(): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT id,titleshort,slug
                                                     FROM Articles
                                                     ORDER BY id desc;');
        $sql->execute();
        return $sql->fetchAll();
    }
}