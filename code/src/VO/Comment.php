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

    public function getArticleID(): int
    {
        return (int)$this->articleID;
    }

    public function getReplytoID(): null|int
    {
        return $this->replytoID;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function getDate(): string
    {
        return $this->date;
    }

    public static function setEntry(ID $articleID, null|int $replytoID, Username $username, CommentText $text)
    {
        //TODO: Verify the data
        return new Comment($articleID, $replytoID, $username, $text);
    }
}