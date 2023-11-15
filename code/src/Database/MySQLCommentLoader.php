<?php

namespace Returnnull;

class MySQLCommentLoader
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ) {}

    public function get($articleID): array
    {
        if ($articleID == LAST_ARTICLE_ID) {
            $articleID = $this->getLastArticleID();
        }
        return $this->fetchComment($articleID);
    }

    private function fetchComment($articleID): array
    {
        $sql = $this->mySQLConnector->prepare('
            SELECT *
            FROM Comments
            WHERE articleID = :articleID;
        ');

        $sql->bindValue(':articleID', $articleID);
        $sql->execute();
        return $sql->fetchAll();
    }

    private function getLastArticleID(): ?int
    {
        $sql = $this->mySQLConnector->prepare('
            SELECT MAX(id) FROM Articles
        ');

        $sql->execute();
        
        $result = $sql->fetchAll();
        if ($result[0][0]) {
            return $result [0][0];
        }
        return null;
    }
}