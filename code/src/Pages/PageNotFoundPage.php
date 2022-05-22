<?php

namespace Returnnull;

class PageNotFoundPage implements Page
{
    public function __construct(
        private PageNotFoundProjector $pageNotFoundProjector
    ){}

    public function run() : void
    {
        http_response_code(404);
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        echo $this->pageNotFoundProjector->getHtml();
    }
}