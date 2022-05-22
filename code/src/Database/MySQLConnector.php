<?php

namespace Returnnull;

class MySQLConnector extends \PDO
{
    public function __construct($config)
    {
        require_once($config);
        try
        {
            parent::__construct(DB_DSN, DB_USER, DB_PASS);
        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

}