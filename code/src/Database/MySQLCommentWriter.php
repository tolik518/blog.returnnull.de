<?php

namespace Returnnull;

class MySQLCommentWriter
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ) {}

    public function save(Comment $comment): void
    {
        $articleID = $comment->getArticleID();
        if ($articleID == LAST_ARTICLE_ID) {
            $articleID = $this->getLastArticleID();
        }

        $sql = $this->mySQLConnector->prepare('
            INSERT INTO Comments (articleID, replytoID, username, text, date) 
            VALUES (:articleID, :replytoID, :username, :text, :date);
        ');

        $sql->bindValue(':articleID', $articleID);
        $sql->bindValue(':replytoID', $comment->getReplytoID());
        $sql->bindValue(':username',  $comment->getUsername());
        $sql->bindValue(':text',      $comment->getText());
        $sql->bindValue(':date',      $comment->getDate());

        //TODO: Verify and exit
        $sql->execute();
    }

    private function getLastArticleID(): int
    {
        $sql = $this->mySQLConnector->prepare('
            SELECT MAX(id) 
            FROM Articles
        ');

        $sql->execute();
        return $sql->fetchAll()[0][0];
    }
}