<?php

namespace Returnnull;

class TrackedUser
{
    private function __construct(
        private string $ip,
        private float $visitedtime,
        private string $url,
        private string $requestprotocol,
        private string $redirectstatus,
        private string $useragent,
        private string $referer
    ) {}

    public function getIp(): string
    {
        return htmlentities((string)$this->ip);
    }

    public function getVisitedTime(): float
    {
        return (float)$this->visitedtime;
    }

    public function getURL(): string
    {
        return htmlentities((string)$this->url);
    }

    public function getRequestProtocol(): string
    {
        return htmlentities((string)$this->requestprotocol);
    }

    public function getRedirectStatus(): string
    {
        return htmlentities((string)$this->redirectstatus);
    }

    public function getUseragent(): string
    {
        return htmlentities((string)$this->useragent);
    }

    public function getReferer(): string
    {
        return htmlentities((string)$this->referer);
    }

    public static function setEntry($ip, $visitedtime, $url, $requestprotocol, $redirectstatus, $useragent, $referer)
    {
        //TODO: Verify the data
        return new TrackedUser($ip, $visitedtime, $url, $requestprotocol, $redirectstatus, $useragent, $referer);
    }
}