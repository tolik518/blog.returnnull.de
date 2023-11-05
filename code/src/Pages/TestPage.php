<?php

namespace Returnnull;

class TestPage extends BasePage
{
    public function run(Request $request): Response
    {
        return new Response('Hello world!');
    }

    public function getSupportedUrlRegexes(): array
    {
        return ['/test/'];
    }
}