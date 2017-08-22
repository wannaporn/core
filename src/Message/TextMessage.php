<?php

namespace LineMob\Core\Message;

use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\TextTemplate;

class TextMessage extends AbstractMessage
{
    /**
     * {@inheritdoc}
     */
    public function supported(AbstractCommand $command)
    {
        return $command->message instanceof TextTemplate;
    }
}
