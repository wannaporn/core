<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class TextTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $emoticon;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $text = $this->text;

        if ($this->emoticon) {
            $emoticon = substr($this->emoticon, 2);
            $emoticon = hex2bin(str_repeat('0', 8 - strlen($emoticon)).$emoticon);
            $emoticon = mb_convert_encoding($emoticon, 'UTF-8', 'UTF-32BE');

            $text = sprintf("%s %s", $emoticon, $this->text);
        }

        return new TextMessageBuilder($text);
    }
}
