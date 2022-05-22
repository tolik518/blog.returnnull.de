<?php

namespace Returnnull;

class MySQLAdminArticleWriter
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function save(Article $article): void
    {
        $sql = $this->mySQLConnector->prepare('INSERT INTO Articles (firstname, lastname, length, title, titleshort, slug, text, description, date) 
                                               VALUES (:firstname, :lastname, :length, :title, :titleshort, :slug, :text, :description, :date);');
        $sql->bindValue(':firstname', $article->getFirstname());
        $sql->bindValue(':lastname',  $article->getLastname());

        $sql->bindValue(':length',    $article->getLength());

        $sql->bindValue(':title',     $article->getTitle());
        $sql->bindValue(':titleshort',$article->getShortTitle());
        $sql->bindValue(':slug',      $article->getSlug());

        $sql->bindValue(':text',      $article->getText());
        $sql->bindValue(':description',      $article->getDescription());

        $sql->bindValue(':date',      $article->getDate());
        //TODO: Überprüfen und beenden
        $sql->execute();
    }
}