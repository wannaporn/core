<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
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
     * @var string[]
     */
    public $extra = [];

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $text = $this->text;

        if ($this->emoticon) {
            $emoticon = substr($this->emoticon, 2);

            if (!$emoticon = @hex2bin(str_repeat('0', 8 - strlen($emoticon)).$emoticon)) {
                throw new \RuntimeException('hex2bin(): Input string must be hexadecimal string. see - https://devdocs.line.me/files/emoticon.pdf');
            }

            $emoticon = mb_convert_encoding($emoticon, 'UTF-8', 'UTF-32BE');

            $text = sprintf("%s %s", $emoticon, $this->text);
        }

        return new TextMessageBuilder($text, ...$this->extra);
    }
}
