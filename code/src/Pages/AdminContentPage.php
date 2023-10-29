<?php

namespace Returnnull;

class AdminContentPage implements Page
{
    public function __construct(
        private AdminContentProjector   $adminProjector,
        private MySQLAdminArticleWriter $mySQLArticleWriter,
        private SessionManager          $sessionManager,
        private VariablesWrapper        $variablesWrapper
    ){}

    public function run(): void
    {
        if ($this->variablesWrapper->isPost()) //sending data
        {
            $this->sendArticleToDB();
        }
        echo $this->adminProjector->getHtml(
            $this->sessionManager->getAuthenticatedUser()
        );
    }

    public function sendArticleToDB(): void
    {
        try
        {
            $entry   = Article::setEntry(
                firstname:  $this->variablesWrapper->getPostParam('author'),
                lastname:   "",
                //the length parameter needs a special treatment since our post variable looks like this "23 Byte", we need to cut off the Byte part
                length:     explode( " ", $this->variablesWrapper->getPostParam('length'))[0],
                title:      $this->variablesWrapper->getPostParam('title'),
                shorttitle: $this->variablesWrapper->getPostParam('shorttitle'),
                text:       $this->variablesWrapper->getPostParam('text'),
                description:$this->variablesWrapper->getPostParam('description'),
                date:       $this->variablesWrapper->getPostParam('date')
            );
            $this->mySQLArticleWriter->save($entry);

        } catch (\InvalidArgumentException $e) {
            //$this->errorStack[] = $e->getMessage();
            echo $e->getMessage();
        }
    }
}