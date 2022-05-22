<?php
namespace Returnnull;

class PageNotFoundProjector
{
    public function getHtml(): string
    {
        return $this->fillContent();
    }

    private function fillContent(): string
    {
        $html   = file_get_contents(HTML . DR . 'PageNotFoundTemplate.html');
        $header = file_get_contents(HTML . '_header.html');
        $head   = file_get_contents(HTML . '_head.html');

        $html   = str_replace('%HEAD%',   $head,   $html);
        $html   = str_replace('%HEADER%', $header, $html);

        return $html;
    }
}