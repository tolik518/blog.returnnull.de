<?php

namespace Returnnull;

use InvalidArgumentException;

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
                throw new InvalidArgumentException('Page must be an instance of BasePage');
            }
        }

        $request = Request::getInstance();

        foreach ($pages as $page) {
            if (!$this->isUrlSupported($request, $page)) {
                continue;
            }

            if ($this->isNotAccessible($page)) {
                return $this->pageFactory->create(AdminLoginPage::class);
            }

            return $page;
        }
        return $this->pageFactory->create(PageNotFoundPage::class);
    }

    private function isUrlSupported(Request $request, Page $page): bool
    {
        foreach ($page->getSupportedUrlRegexes() as $regex) {
            if (preg_match($regex, $request->getUri())) {
                return true;
            }
        }
        return false;
    }

    private function fetchPages(): array
    {
        $classesAll = $this->fileSystem->getFilesFromPath(__DIR__ . '/Pages', 'php');
        // Filter out the "Page" Interface
        $classes = array_filter($classesAll, static function($class) {
            return $class !== 'Page';
        });

        $pages = [];
        foreach ($classes as $class) {
            $pages[] = $this->pageFactory->create($class);
        }

        return $pages;
    }

    private function isNotAccessible(Page $page): bool
    {
        return $page->isProtected() && $this->sessionManager->isAuthenticated() === false;
    }
}
