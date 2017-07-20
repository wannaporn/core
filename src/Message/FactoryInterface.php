<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;

interface FactoryInterface
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
