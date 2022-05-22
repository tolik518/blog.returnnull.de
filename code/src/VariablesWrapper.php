<?php

namespace Returnnull;

class VariablesWrapper
{
    public function isPost(): bool
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }
        return false;
    }

    public function isGet(): bool
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return true;
        }
        return false;
    }

    public function getPostParam($param)
    {
        if(!empty($_POST[$param]))
        {
            return $_POST[$param];
        }
        return "";
    }

    public function getGetParam($param)
    {
        if(!isset($_GET[$param]))
        {
            return $_GET[$param];
        }
        return null;
    }

    public function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getServerVar(string $var)
    {
        return $_SERVER[$var];
    }
}