<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\TemplateInterface;

interface MessageInterface
{
    /**
     * @param TemplateInterface $template
     *
     * @return MessageBuilder
     */
    public function createTemplate(TemplateInterface $template);

    /**
     * @param AbstractCommand $command
     *
     * @return boolean
     */
    public function supported(AbstractCommand $command);
}
