<?php

namespace LineMob\Core\Factory;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Message\MessageInterface;

interface MessageFactoryInterface
{
    /**
     * @param MessageInterface $message
     */
    public function add(MessageInterface $message);

    /**
     * @param AbstractCommand $command
     *
     * @return MessageBuilder
     * @throws  \RuntimeException
     */
    public function createMessage(AbstractCommand $command);
}
