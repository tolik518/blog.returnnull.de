<?php

namespace Returnnull;

class VariablesWrapper
{
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function getPostParam($param)
    {
        if (!empty($_POST[$param]))
        {
            return $_POST[$param];
        }

        return null;
    }

    public function getGetParam($param)
    {
        return $_GET[$param] ?? null;
    }

    public function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getServerVar(string $var)
    {
        if (!empty($_SERVER[$var]))
        {
            return $_SERVER[$var];
        }

        return "";
    }
}