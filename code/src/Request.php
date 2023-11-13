<?php

namespace Returnnull;

class Request
{
    private static ?Request $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): Request
    {
        if (self::$instance === null) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }

    public function getQuery()
    {
        return $_GET;
    }

    public function getQueryValue(string $name)
    {
        return $this->getQuery()[$name];
    }

    public function getPost()
    {
        return $_POST;
    }

    public function getPostValue(string $name)
    {
        return $this->getPost()[$name];
    }

    public function getFiles()
    {
        return $_FILES;
    }

    public function getFilesValue(string $name)
    {
        return $this->getFiles()[$name];
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function getHeader(string $name)
    {
        return $this->getHeaders()[$name];
    }

    public function getCookie()
    {
        return $_COOKIE;
    }

    public function getCookieValue(string $name)
    {
        return $this->getCookie()[$name];
    }

    public function getServer()
    {
        return $_SERVER;
    }

    public function getServerValue(string $name)
    {
        return $this->getServer()[$name];
    }

    public function getSession()
    {
        return $_SESSION;
    }

    public function getSessionValue(string $name)
    {
        return $this->getSession()[$name];
    }
}
