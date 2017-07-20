<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;

interface MessageInterface
{
    /**
     * @param AbstractCommand $command
     *
     * @return MessageBuilder
     */
    public function createTemplate(AbstractCommand $command);

    /**
     * @param AbstractCommand $command
     *
     * @return boolean
     */
    public function supported(AbstractCommand $command);
}
