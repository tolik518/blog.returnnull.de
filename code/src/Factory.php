<?php

namespace Returnnull;

class Factory
{
    private MySQLConnector $mySQLConnector;

    public function createApplication(MySQLConnector $mySQLConnector): Application
    {
        $this->mySQLConnector = $mySQLConnector;
        return new Application(
            $this->createRouter(),
            new Tracker(
                new MySQLTrackerWriter(
                    $this->mySQLConnector
                ),
                new VariablesWrapper()
            )
        );
    }

    private function createRouter(): Router
    {
        return new Router(
            new PageFactory(
                $this->mySQLConnector
            ),
            new FileSystem(),
            new VariablesWrapper(),
            new SessionManager()
        );
    }
}