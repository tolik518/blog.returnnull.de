<?php

namespace Returnnull;

class AdminLoginPage implements Page
{
    public function __construct(
        private AdminLoginProjector   $adminLoginProjector,
        private MySQLAdminLogin       $mySQLAdminLogin,
        private SessionManager        $sessionManager,
        private VariablesWrapper      $variablesWrapper
    ){}

    public function run(): void
    {
        if ($this->variablesWrapper->isPost()) {
            if ($this->variablesWrapper->getPostParam('login2') !== null) {
                $this->loginAdmin();//logging in
            }
        }
        echo $this->adminLoginProjector->getHtml();
    }

    private function loginAdmin(): void
    {
        $username = $this->variablesWrapper->getPostParam('usr');
        $password = $this->variablesWrapper->getPostParam('pswd');

        if ($this->mySQLAdminLogin->login($username, $password)) {
            $this->sessionManager->setAuthenticatedUser($username);
        }
    }
}