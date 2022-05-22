<?php

namespace Returnnull;

class CommentText
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $this->filter($text);
    }

    private function filter($text): string
    {
        $badwords = $this->getBadwords();

        if ($text == '' || $text == null) {
            throw new \InvalidArgumentException('Ungültige Nachricht:<br /> Nachricht kann nicht leer sein.');
        }
        return htmlspecialchars(str_replace($badwords, "!@#%?", $text));
    }

    private function getBadwords()
    {
        $filename = SRC . "_badwords.txt";
        $fp = fopen($filename, 'r');

        if ($fp) {
            return explode("\n", fread($fp, filesize($filename)));
        }
    }

    public function __toString()
    {
        return $this->text;
    }

    public static function fromString(string $text)
    {
        return new CommentText($text);
    }
}
