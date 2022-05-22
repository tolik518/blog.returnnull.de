<?php

namespace Returnnull;

class MySQLAdminLogin
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function login($username, $password): bool
    {
        $sql = $this->mySQLConnector->prepare('SELECT * FROM Users
                                                              WHERE username=:username');
        $sql->bindValue(':username', $username);
        $sql->execute();
        $result = $sql->fetch();

        if (!$result) {
            return false; //falscher username
        }

        if (password_verify($password, $result['password'])) {
            return true;
        }

        return false; //falsches passwort
    }
}