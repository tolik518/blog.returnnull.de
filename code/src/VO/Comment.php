<?php

namespace Returnnull;

class Comment
{
    private int $articleID;
    private null|int $replytoID;
    private string $username;
    private string $text;
    private string $date;

    public function __construct(ID $articleID, null|int $replytoID, Username $username, CommentText $text)
    {
        $this->articleID = (int)(string)$articleID;
        $this->replytoID = null;
        $this->username  = (string)$username;
        $this->text      = (string)$text;
        $this->date      = date('Y-m-d H:i:s');
    }

    public function getArticleID(){
        return (int)$this->articleID;
    }

    public function getReplytoID(){
        return $this->replytoID;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getText(){
        return $this->text;
    }
    public function getDate(){
        return $this->date;
    }

    public static function setEntry(ID $articleID, null|int $replytoID, Username $username, CommentText $text)
    {
        //TODO: Daten verifizieren evtl
        return new Comment($articleID, $replytoID, $username, $text);
    }
}