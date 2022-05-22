<?php

namespace Returnnull;

class MySQLAdminLogin
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function login($username, $password) : bool
    {
        $sql = $this->mySQLConnector->prepare('SELECT * FROM Users
                                                              WHERE username=:username');
        $sql->bindValue(':username', $username);
        $sql->execute();
        $result = $sql->fetch();

        if ($result)
        {
            if(password_verify($password,$result['password']))
            {
                return true;
            }
            else
            {
                return false; //falsches passwort
            }
        }
        else
        {
            return false; //falscher username
        }
    }
}