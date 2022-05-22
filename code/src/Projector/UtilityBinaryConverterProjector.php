<?php
namespace Returnnull;

class UtilityBinaryConverterProjector
{
    public function getHtml(): string
    {
        return $this->fillContent();
    }

    private function fillContent(): string
    {
        $html   = file_get_contents(HTML .'utility' . DR . 'utilityBinaryConverterTemplate.html');
        $header = file_get_contents(HTML . '_header.html');

        $html   = str_replace('%HEADER%', $header, $html);

        return $html;
    }
}