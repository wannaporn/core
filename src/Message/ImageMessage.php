<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Constants;

class ImageMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTemplate(AbstractCommand $command)
    {
        $originalUrl = $command['originalUrl'];
        $previewImageUrl = $command['previewImageUrl'];

        return new ImageMessageBuilder($originalUrl, $previewImageUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function supported(AbstractCommand $command)
    {
        return Constants::TYPE_IMAGE == $command->type;
    }
}
