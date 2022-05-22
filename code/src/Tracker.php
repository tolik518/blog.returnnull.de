<?php

namespace Returnnull;

class Tracker
{
    public function __construct(
        private MySQLTrackerWriter $mySQLTrackerWriter,
        private VariablesWrapper $variablesWrapper
    ){}

    public function trackUserInfo(): void
    {
        $REMOTE_ADDR        = IPadress::fromString($this->variablesWrapper->getServerVar('REMOTE_ADDR') ?? "0.0.0.0");
        $REQUEST_TIME_FLOAT = $this->variablesWrapper->getServerVar('REQUEST_TIME_FLOAT') ?? 0.0;
        $REQUEST_URI        = $this->variablesWrapper->getServerVar('REQUEST_URI')        ?? "unknown";
        $REQUEST_SCHEME     = $this->variablesWrapper->getServerVar('REQUEST_SCHEME')     ?? "unknown";
        $REDIRECT_STATUS    = $this->variablesWrapper->getServerVar('REDIRECT_STATUS')    ?? "unknown";
        $HTTP_USER_AGENT    = $this->variablesWrapper->getServerVar('HTTP_USER_AGENT')    ?? "unknown";
        $HTTP_REFERER       = $this->variablesWrapper->getServerVar('HTTP_REFERER')       ?? "unknown";

        $trackeduser = TrackedUser::setEntry(
            $REMOTE_ADDR,
            $REQUEST_TIME_FLOAT,
            $REQUEST_URI,
            $REQUEST_SCHEME,
            $REDIRECT_STATUS,
            $HTTP_USER_AGENT ,
            $HTTP_REFERER
        );

        $this->mySQLTrackerWriter->write($trackeduser);
    }
}