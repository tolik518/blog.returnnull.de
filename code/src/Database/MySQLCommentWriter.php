<?php

namespace Returnnull;

class MySQLCommentWriter
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function save(Comment $comment)
    {
        $articleID = $comment->getArticleID();
        if ($articleID == LAST_ARTICLE_ID){
            $articleID = $this->getLastArticleID();
        }

        $sql = $this->mySQLConnector->prepare('INSERT INTO Comments (articleID, replytoID, username, text, date) 
                                                                VALUES (:articleID, :replytoID, :username, :text, :date);');

        $sql->bindValue(':articleID', $articleID);
        $sql->bindValue(':replytoID', $comment->getReplytoID());
        $sql->bindValue(':username',  $comment->getUsername());
        $sql->bindValue(':text',      $comment->getText());
        $sql->bindValue(':date',      $comment->getDate());

        //TODO: Überprüfen und beenden
        $sql->execute();
    }

    private function getLastArticleID(){
        $sql = $this->mySQLConnector->prepare('select MAX(id) from Articles');
        $sql->execute();
        return $sql->fetchAll()[0][0];
    }
}