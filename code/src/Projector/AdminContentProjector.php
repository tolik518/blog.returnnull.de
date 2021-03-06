<?php

namespace Returnnull;

class AdminContentProjector
{
    public function getHtml(): string
    {
        return $this->fillContent();
    }

    private function fillContent(): string
    {
        $html   = file_get_contents(HTML . 'newPostTemplate.html');
        $header = file_get_contents(HTML . '_header.html');
        $head   = file_get_contents(HTML . '_head.html');

        $html   = str_replace('%HEAD%',   $head,   $html);
        $html   = str_replace('%HEADER%', $header, $html);

        return $html;
    }
}