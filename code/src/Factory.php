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
            $this->createAdminContentPage(),
            $this->createAdminLoginPage(),
            $this->createArticlePage(),
            new PageNotFoundPage(
                new PageNotFoundProjector()
            ),
            new UtilityBinaryConverterPage(
                new UtilityBinaryConverterProjector()
            ),
            new VariablesWrapper(),
            new SessionManager()
        );
    }

    private function createAdminContentPage(): AdminContentPage
    {
        return new AdminContentPage(
            new AdminContentProjector(),
            new MySQLAdminArticleWriter(
                $this->mySQLConnector
            ),
            new VariablesWrapper()
        );
    }

    private function createAdminLoginPage(): AdminLoginPage
    {
        return new AdminLoginPage(
            new AdminLoginProjector(),
            new MySQLAdminLogin(
                $this->mySQLConnector
            ),
            new SessionManager(),
            new VariablesWrapper()
        );
    }

    private function createArticlePage(): ArticlePage
    {
       return new ArticlePage(
            new ArticleProjector(),
            new MySQLArticleLoader(
                $this->mySQLConnector
            ),
            new MySQLCommentLoader(
                $this->mySQLConnector
            ),
            new MySQLCommentWriter(
                $this->mySQLConnector
            ),
            new MySQLMenuLoader(
                $this->mySQLConnector
            ),
            new MySQLTagsLoader(
                $this->mySQLConnector
            ),
            new SessionManager(),
            new VariablesWrapper()
        );
    }
}