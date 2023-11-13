<?php

namespace Returnnull;

class PageFactory
{
    private MySQLConnector $mySQLConnector;

    public function __construct(MySQLConnector $mySQLConnector)
    {
        $this->mySQLConnector = $mySQLConnector;
    }

    public function create(string $pageClassName): Page
    {
        $pageName = $this->getPageNameFromClass($pageClassName);

        switch ($pageName) {
            case 'AdminContentPage':
                return $this->createAdminContentPage();
            case 'AdminLoginPage':
                return $this->createAdminLoginPage();
            case 'ArticlePage':
                return $this->createArticlePage();
            case 'PageNotFoundPage':
                return $this->createPageNotFoundPage();
            case 'UtilityBinaryConverterPage':
                return $this->createUtilityBinaryConverterPage();
            default:
                return $this->tryToGetFallbackPage($pageName);
        }
    }

    private function getPageNameFromClass(string $pageClassName): string
    {
        $array = explode("\\", $pageClassName); // split namespace from classname
        return end($array);
    }

    private function tryToGetFallbackPage(string $pageName): Page
    {
        // if not defined in the factory, try to load it dynamically
        $dynamicPath = __DIR__ . '/../Pages/' . $pageName . '.php';
        if (file_exists($dynamicPath)) {
            require_once $dynamicPath;
            $className = 'Returnnull\\' . $pageName;
            return new $className;
        }
        // otherwise throw an exception about missing page or arguments
        throw new \InvalidArgumentException('Page not found, check if it is defined in the PageFactory');
    }

    private function createAdminContentPage(): AdminContentPage
    {
        return new AdminContentPage(
            new AdminContentProjector(),
            new MySQLAdminArticleWriter(
                $this->mySQLConnector
            ),
            new SessionManager(),
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
            new ArticleProjector(
                new MessageProjector()
            ),
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
            new VariablesWrapper()
        );
    }

    private function createPageNotFoundPage(): PageNotFoundPage
    {
        return new PageNotFoundPage(
            new PageNotFoundProjector()
        );
    }

    private function createUtilityBinaryConverterPage(): UtilityBinaryConverterPage
    {
        return new UtilityBinaryConverterPage(
            new UtilityBinaryConverterProjector()
        );
    }
}
