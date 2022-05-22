<?php

namespace Returnnull;

class MySQLTagsLoader
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function get($articleID)
    {
        if ($articleID == LAST_ARTICLE_ID){
            $articleID = $this->getLastArticleID();
        }
        return $this->fetchTags($articleID);
    }

    private function fetchTags($articleID)
    {
        $sql = $this->mySQLConnector->prepare('SELECT tagsID
                                                     FROM ArticleTags
                                                     WHERE articleID = :articleID;');
        $sql->bindValue(':articleID', $articleID);
        $sql->execute();

        $tagIDs = $sql->fetchAll(\PDO::FETCH_COLUMN);

        if(empty($tagIDs)){
            return $tagIDs;
        }
        $in = '(' . implode(',', $tagIDs) .')';

        $sql = $this->mySQLConnector->prepare('SELECT tag 
                                                     FROM Tags 
                                                     WHERE id IN ' . $in.';');
        $sql->execute();
        $tags = $sql->fetchAll(\PDO::FETCH_COLUMN);
        return $tags;
    }

    private function getLastArticleID()
    {
        $sql = $this->mySQLConnector->prepare('select MAX(id) from Articles');
        $sql->execute();
        return $sql->fetchAll()[0][0];
    }
}