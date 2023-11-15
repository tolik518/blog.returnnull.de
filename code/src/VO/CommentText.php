<?php

namespace Returnnull;

class CommentText
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $this->filter($text);
    }

    private function filter(string $text): string
    {
        $badwords = $this->getBadwords();

        if ($text == '' || $text == null) {
            throw new \InvalidArgumentException('Invalid message:<br /> Message cant be empty.');
        }

        return htmlspecialchars(str_replace($badwords, "!@#%?", $text));
    }

    private function getBadwords(): array
    {
        $filename = SRC . "_badwords.txt";
        $fp = fopen($filename, 'r');

        if ($fp) {
            return explode("\n", fread($fp, filesize($filename)));
        }
        return [];
    }

    public function __toString(): string
    {
        return $this->text;
    }

    public static function fromString(string $text): CommentText
    {
        return new CommentText($text);
    }
}
