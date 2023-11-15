<?php

namespace Returnnull;

class Article
{
    private function __construct(
        private $firstname,
        private $lastname,
        private $length,
        private $title,
        private $shorttitle,
        private $text,
        private $description,
        private $date
    ) {}

    public function getSlug(): string
    {
        $slug = trim($this->title); //remove whitespaces at start and end
        $slug = preg_replace('/\s+/','_', $slug); //replace whitespaces
        $slug = preg_replace('/[^\w]+/','', $slug);

        return $slug;
    }

    public function getDescription(): string
    {
        return (string)$this->description;
    }

    public function getFirstname(): string
    {
        return (string)$this->firstname;
    }

    public function getLastname(): string
    {
        return (string)$this->lastname;
    }

    public function getLength(): string
    {
        return (int)$this->length;
    }

    public function getTitle(): string
    {
        return (string)$this->title;
    }

    public function getShortTitle(): string
    {
        return (string)$this->shorttitle;
    }

    public function getText(): string
    {
        return (string)$this->text;
    }

    public function getDate(): string
    {
        return (string)$this->date;
    }

    public static function parseID(string $ID)
    {
        if ($ID == (int)$ID) {
            return (string)$ID;
        }

        return LAST_ARTICLE_ID;
    }

    public static function setEntry($firstname, $lastname, $length, $title, $shorttitle, $text,$description, $date)
    {
        //TODO: Verify the data
        return new Article($firstname, $lastname, $length, $title, $shorttitle, $text,$description, $date);
    }
}