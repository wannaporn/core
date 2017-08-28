<?php

namespace spec\LineMob\Core\Template;

use LINE\LINEBot\Constant\MessageType;
use LineMob\Core\Template\TextTemplate;
use PhpSpec\ObjectBehavior;

/**
 * @mixin TextTemplate
 */
class TextTemplateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TextTemplate::class);
    }

    function it_should_build_text_message_without_emoticon()
    {
        $this->text = $text = 'Hi, LineMob!';

        $this->getTemplate()->buildMessage()->shouldReturn(
            [
                [
                    'type' => MessageType::TEXT,
                    'text' => $text,
                ],
            ]
        );
    }

    function it_should_build_multiple_texts()
    {
        $this->text = $text = 'Hi, LineMob!';
        $this->extra = $extra = ['Im a Bot', 'Im a Bot too!'];

        $this->getTemplate()->buildMessage()->shouldReturn(
            [
                [
                    'type' => MessageType::TEXT,
                    'text' => $text,
                ],
                [
                    'type' => MessageType::TEXT,
                    'text' => $extra[0],
                ],
                [
                    'type' => MessageType::TEXT,
                    'text' => $extra[1],
                ],
            ]
        );
    }

    function it_should_build_text_message_with_emoticon()
    {
        $this->text = $text = 'Hi, LineMob!';
        $this->emoticon = $emoticon = '0x10006C';

        $emoticon = substr($emoticon, 2);
        $emoticon = hex2bin(str_repeat('0', 8 - strlen($emoticon)).$emoticon);
        $emoticon = mb_convert_encoding($emoticon, 'UTF-8', 'UTF-32BE');


        $this->getTemplate()->buildMessage()->shouldReturn(
            [
                [
                    'type' => MessageType::TEXT,
                    'text' => sprintf("%s %s", $emoticon, $text),
                ],
            ]
        );
    }

    function it_should_throw_exception_when_input_none_hexadecimal_emoticon()
    {
        $this->text = 'Hi, LineMob!';
        $this->emoticon = ':smile';

        $this->shouldThrow(
            new \RuntimeException('hex2bin(): Input string must be hexadecimal string. see - https://devdocs.line.me/files/emoticon.pdf')
        )->during('getTemplate');
    }
}
