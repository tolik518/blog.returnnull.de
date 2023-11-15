<?php

namespace Returnnull;

class Tracker
{
    public function __construct(
        private MySQLTrackerWriter $mySQLTrackerWriter,
        private VariablesWrapper $variablesWrapper
    ) {}

    public function trackUserInfo(): void
    {
        $ip          = IpAdress::fromString($this->variablesWrapper->getServerVar('REMOTE_ADDR') ?? "0.0.0.0");
        $visitedtime = $this->variablesWrapper->getServerVar('REQUEST_TIME_FLOAT')  ?? 0.0;
        $url         = $this->variablesWrapper->getServerVar('REQUEST_URI')         ?? "unknown";
        $requestprotocol = $this->variablesWrapper->getServerVar('REQUEST_SCHEME')  ?? "unknown";
        $redirectstatus  = $this->variablesWrapper->getServerVar('REDIRECT_STATUS') ?? "unknown";
        $useragent    = $this->variablesWrapper->getServerVar('HTTP_USER_AGENT')    ?? "unknown";
        $referer      = $this->variablesWrapper->getServerVar('HTTP_REFERER')       ?? "unknown";

        $trackeduser = TrackedUser::setEntry(
            $ip,
            $visitedtime,
            $url,
            $requestprotocol,
            $redirectstatus,
            $useragent ,
            $referer
        );

        $this->mySQLTrackerWriter->write($trackeduser);
    }
}