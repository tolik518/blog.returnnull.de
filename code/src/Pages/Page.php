<?php

namespace Returnnull;

interface Page
{
    /**
     * Takes a Request and returns a Response containing the html content
     *
     * @param Request $request
     *
     * @return Response
     */
    public function run(Request $request): Response;

    /**
     * Returns an array of Regexes for the URL
     *
     * @return array
     */
    public function getSupportedUrlRegexes(): array;

    /**
     * Checks if the page only viewable by the admin
     *
     * @return bool
     */
    public function isProtected(): bool;
}