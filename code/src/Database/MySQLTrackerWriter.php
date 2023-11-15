<?php

namespace Returnnull;

class MySQLTrackerWriter
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ) {}

    public function write(TrackedUser $trackedUser): void
    {
        $sql = $this->mySQLConnector->prepare('
            INSERT INTO Tracker (ip, visitedtime, url, requestprotocol, redirectstatus, useragent, refferer) 
            VALUES (:ip, :visitedtime, :url, :requestprotocol, :redirectstatus, :useragent, :refferer);
        ');

        $sql->bindValue(':ip',              $trackedUser->getIp());
        $sql->bindValue(':visitedtime',     $trackedUser->getVisitedTime());
        $sql->bindValue(':url',             $trackedUser->getURL());
        $sql->bindValue(':requestprotocol', $trackedUser->getRequestProtocol());
        $sql->bindValue(':redirectstatus',  $trackedUser->getRedirectStatus());
        $sql->bindValue(':useragent',       $trackedUser->getUseragent());
        $sql->bindValue(':refferer',        $trackedUser->getReferer());
        $sql->execute();
    }
}