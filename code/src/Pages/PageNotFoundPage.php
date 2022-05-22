<?php

namespace Returnnull;

class PageNotFoundPage implements Page
{
    public function run() : void
    {
        http_response_code(403);
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    }
}