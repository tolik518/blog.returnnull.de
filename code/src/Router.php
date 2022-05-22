<?php

namespace Returnnull;

class Router
{
    public function __construct(
        private AdminContentPage $adminContentPage,
        private AdminLoginPage   $adminLoginPage,
        private ArticlePage      $articlePage,
        private PageNotFoundPage $pagePotFoundPage,
        private UtilityBinaryConverterPage $utilityBinaryConverterPage,
        private VariablesWrapper $variablesWrapper,
        private SessionManager   $sessionManager
    ){}

    public function getPageForUrl() : Page
    {
        switch ((string)$this->variablesWrapper->getRequestUri())
        {
            case '/admin':
                if ($this->sessionManager->isAuthenticated()) {
                    return $this->adminContentPage;
                }
                return $this->adminLoginPage;
            case '/utility/4B5B_to_MLT3_converter/':
            case '/utility/Binary_to_MLT3_converter/':
            case '/utility/Binary_to_MLT3_online_converter/':
                return $this->utilityBinaryConverterPage;
            //case preg_match('/\/([A-Za-z]\w+)\/\?article\=[0-9]{1,5}/', (string)$this->variablesWrapper->getRequestUri()):
            case'':
            case'/':
            default:
                return $this->articlePage; //TODO: 404 Seite
        }
    }
}