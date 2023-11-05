<?php

namespace Returnnull;

class Router
{
    public function __construct(
        private PageFactory $pageFactory,
        private FileSystem  $fileSystem,
        private VariablesWrapper $variablesWrapper,
        private SessionManager   $sessionManager
    ) {
    }

    public function getPageForUrl(): Page
    {
        $classes = $this->fileSystem->getFilesFromPath(__DIR__ . '/Pages', 'php');
        foreach ($classes as $class) {
            $pages[] = $this->pageFactory->create($class);
        }

        foreach ($pages as $page) {
            if ($page instanceof BasePage === false) {
                throw new \InvalidArgumentException('Page must be an instance of BasePage');
            }

            if ($page->isUrlSupported((string)$this->variablesWrapper->getRequestUri())) {
                if ($page->isProtected()) {
                    if ($this->sessionManager->isAuthenticated() === false) {
                        return $this->pageFactory->create('AdminLoginPage');
                    }
                }
                return $page;
            }
        }

        return $this->pageFactory->create('PageNotFoundPage');
    }
}
