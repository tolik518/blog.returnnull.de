<?php

namespace Returnnull;

class Router
{
    public function __construct(
        private PageFactory $pageFactory,
        private FileSystem  $fileSystem,
        private SessionManager   $sessionManager
    ) {
    }

    public function getPageForUrl(): Page
    {
        $pages = $this->fetchPages();

        if (empty($pages)) {
            return $this->pageFactory->create(PageNotFoundPage::class);
        }

        foreach ($pages as $page) {
            if (!($page instanceof Page)) {
                throw new \InvalidArgumentException('Page must be an instance of BasePage');
            }
        }

        $request = Request::getInstance();

        foreach ($pages as $page) {
            if (!$page->isUrlSupported($request)) {
                continue;
            }

            if ($this->isNotAccessible($page)) {
                return $this->pageFactory->create(AdminLoginPage::class);
            }

            return $page;
        }
        return $this->pageFactory->create(PageNotFoundPage::class);
    }

    private function fetchPages(): array
    {
        $classes = $this->fileSystem->getFilesFromPath(__DIR__ . '/Pages', 'php');
        $pages = [];
        foreach ($classes as $class) {
            $pages[] = $this->pageFactory->create($class);
        }

        return $pages;
    }

    public function isNotAccessible(Page $page): bool
    {
        return $page->isProtected() && $this->sessionManager->isAuthenticated() === false;
    }
}
