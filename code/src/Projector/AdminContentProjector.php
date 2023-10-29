<?php

namespace Returnnull;

class AdminContentProjector
{
    public function getHtml(string $user = null): string
    {
        return $this->fillContent($user);
    }

    private function fillContent(string $user = null): string
    {
        $html   = file_get_contents(HTML . 'newPostTemplate.html');
        $header = file_get_contents(HTML . '_header.html');
        $head   = file_get_contents(HTML . '_head.html');

        $html   = str_replace('%HEAD%',   $head,   $html);
        $html   = str_replace('%HEADER%', $header, $html);
        $html   = str_replace('%CURRENTUSER%', $user, $html);

        return $html;
    }
}