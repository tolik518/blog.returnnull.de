<?php

namespace Returnnull;

class MessageProjector
{
    CONST AVAILABLE_TYPES = ['success', 'info', 'warning', 'error'];
    private $messages = [];

    public function addMessage($type, $title, $text): void
    {
        if (in_array($type, self::AVAILABLE_TYPES) === false) {
            throw new \Exception(sprintf('Message type %s not available! Possible values: %s', $type, implode(', ', self::AVAILABLE_TYPES)));
        }
        $this->messages[] = ['type' => $type, 'title' => $title, 'text' => $text];
    }

    public function getHtml(): string
    {
        return $this->fillContent();
    }

    private function fillContent(): string
    {
        $messageHtml = '';

        foreach ($this->messages as $message) {
            $messageHtml .= str_replace(
                ['%TITLE%', '%TEXT%', '%TYPE%'],
                [$message['title'], $message['text'], $message['type']],
                file_get_contents(HTML . '_messageTemplate.html')
            );
        }

        return $messageHtml;
    }
}
