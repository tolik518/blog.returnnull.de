<?php

namespace Returnnull;

class PageNotFoundPage extends BasePage
{
    public function __construct(
        private PageNotFoundProjector $pageNotFoundProjector
    ){}

    public function run(Request $request): Response
    {
        return new Response(
            $this->pageNotFoundProjector->getHtml(),
            404
        );
    }

    public function getSupportedUrlRegexes(): array
    {
        return [''];
    }

    public function isUrlSupported(string $path): bool
    {
        // special case! this page is not supported, becouse it have to be the last page in the chain!
        return false;
    }
}