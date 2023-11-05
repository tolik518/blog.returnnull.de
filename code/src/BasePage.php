<?php

namespace Returnnull;

class BasePage implements Page {

    public function run(Request $request): Response
    {
        throw new \Exception('Implement run() method.');
    }

    public function getSupportedUrlRegexes(): array
    {
        throw new \Exception('Implement getSupportedUrlRegexes() method.');
    }

    public function isUrlSupported(Request $request): bool
    {
        foreach ($this->getSupportedUrlRegexes() as $regex) {
            if (preg_match($regex, $request->getUri())) {
                return true;
            }
        }
        return false;
    }


    public function isProtected(): bool
    {
        return false;
    }
}