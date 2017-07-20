<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Constants;

class TextMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTemplate(AbstractCommand $command)
    {
        $message = $command->message;

        if ($command->emoticon) {
            $emoticon = substr($command->emoticon, 2);
            $emoticon = hex2bin(str_repeat('0', 8 - strlen($emoticon)).$emoticon);
            $emoticon = mb_convert_encoding($emoticon, 'UTF-8', 'UTF-32BE');

            $message = sprintf("%s %s", $emoticon, $message);
        }

        return new TextMessageBuilder($message);
    }

    /**
     * {@inheritdoc}
     */
    public function supported(AbstractCommand $command)
    {
        return Constants::TYPE_TEXT == $command->type;
    }
}
