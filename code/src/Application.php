<?php

namespace Returnnull;

class Application
{
    private Page $page;
    private Tracker $tracker;

    public function __construct(Router $router, Tracker $tracker)
    {
        $this->page = $router->getPageForUrl();
        $this->tracker = $tracker;
    }

    public function run(): void
    {
        $this->tracker->trackUserInfo();
        $this->page->run(Request::getInstance())->send();
    }
}