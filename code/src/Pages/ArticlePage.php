<?php

namespace Returnnull;

class ArticlePage implements Page
{
    private $errorStack = [];

    public function __construct(
        private ArticleProjector   $landingProjector,
        private MySQLArticleLoader $mySQLArticleLoader,
        private MySQLCommentLoader $mySQLCommentLoader,
        private MySQLCommentWriter $mySQLCommentWriter,
        private MySQLMenuLoader    $mySQLMenuLoader,
        private MySQLTagsLoader    $mySQLTagsLoader,
        private SessionManager     $sessionManager,
        private VariablesWrapper   $variablesWrapper
    ){}

    public function run(): void
    {
        //TODO: DO NOT pass $_GET['article']
        if(isset($_GET['article'])){
            $articleID = Article::parseID($_GET['article']);
        } else {
            $articleID = LAST_ARTICLE_ID;
        }

        if ($this->variablesWrapper->isPost()) //sending data
        {
            if(!empty($_POST['website']) || !empty($_POST['comment'])){ //Anti-Spam -> wenn ausgefüllt wurde, dann Spam
                http_response_code(400);
                exit();
            }
            $this->sendCommentToDB();
        }

        if(!empty($this->errorStack)){
            echo $this->landingProjector->getHtml($this->mySQLArticleLoader->get($articleID),
                $this->mySQLCommentLoader->get($articleID),
                $this->mySQLMenuLoader->get(),
                $this->mySQLTagsLoader->get($articleID),
                $this->errorStack);
        } else {
            echo $this->landingProjector->getHtml($this->mySQLArticleLoader->get($articleID),
                $this->mySQLCommentLoader->get($articleID),
                $this->mySQLMenuLoader->get(),
                $this->mySQLTagsLoader->get($articleID));
        }


    }
    public function sendCommentToDB()
    {
        if(isset($_GET['article'])){
            $articleID = Article::parseID($_GET['article']);
        } else {
            $articleID = LAST_ARTICLE_ID;
        }

        try{
            $entry = Comment::setEntry(
                articleID: ID::fromString($articleID),
                replytoID: null,
                username: Username::fromString($this->variablesWrapper->getPostParam('commentUsername')),
                text:     CommentText::fromString($this->variablesWrapper->getPostParam('commentText'))
            );
            $this->mySQLCommentWriter->save($entry);

        }  catch (\InvalidArgumentException $e) {
            $this->errorStack[] = $e->getMessage();
        }
    }
}