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
        if (isset($_GET['article'])) {
            $articleID = Article::parseID($_GET['article']);
        } else {
            $articleID = LAST_ARTICLE_ID;
        }

        if ($this->variablesWrapper->isPost()) //sending data
        {
            if (!empty($_POST['website']) || !empty($_POST['comment'])) { //Anti-Spam -> wenn ausgefüllt wurde, dann Spam
                http_response_code(400);
                exit();
            }
            $this->sendCommentToDB();
        }

        $article = $this->mySQLArticleLoader->get($articleID);
        $comments = $this->mySQLCommentLoader->get($articleID);
        $menupoints = $this->mySQLMenuLoader->get();
        $tags = $this->mySQLTagsLoader->get($articleID);

        if (empty($this->errorStack)) {
            echo $this->landingProjector->getHtml($article, $comments, $menupoints, $tags);
        } else {
            echo $this->landingProjector->getHtml($article, $comments, $menupoints, $tags, $this->errorStack);
        }
    }
    public function sendCommentToDB(): void
    {
        if ($this->variablesWrapper->getGetParam('article') === null) {
            $articleID = LAST_ARTICLE_ID;
        } else {
            $articleID = Article::parseID($_GET['article']);
        }

        try
        {
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