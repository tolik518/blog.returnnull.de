<?php

namespace Returnnull;

class MySQLArticleLoader
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function get(int $articleID = LAST_ARTICLE_ID): array
    {
        $result = [];

        if ($articleID == LAST_ARTICLE_ID) { 
            $articleID = $this->getLastArticleID();
         }

        if ($articleID) {
            $result = $this->fetchArticle($articleID);
         }

        if (!empty($result)) {
            return $result[0];
        }

        return $result;
    }

    private function fetchArticle(int $articleID): array
    {
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                     FROM Articles
                                                     WHERE id = :id;');
        $sql->bindValue(':id', $articleID);
        $sql->execute();
        return $sql->fetchAll();
    }

    private function getLastArticleID(): ?int
    {
        $sql = $this->mySQLConnector->prepare('SELECT MAX(id) FROM Articles');
        $sql->execute();
        
        $result = $sql->fetchAll();
        if ($result[0][0]) {
            return $result [0][0];
        }
        return null;
    }
}