<?php

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Constants;

class CarouselMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTemplate(AbstractCommand $command)
    {
        $carousels = [];

        foreach ($command['carousels'] as $carousel) {
            $actions = [];

            foreach ($carousel['actions'] as $action) {
                $actions[] = new UriTemplateActionBuilder($action['label'], $action['link']);
            }

            $carousels[] = new CarouselColumnTemplateBuilder(
                mb_substr($carousel['title'], 0, 40),
                mb_substr($carousel['text'], 0, 60),
                $carousel['thumbnail'],
                $actions
            );
        }

        return new CarouselTemplateBuilder($carousels);
    }

    /**
     * {@inheritdoc}
     */
    public function supported(AbstractCommand $command)
    {
        return Constants::TYPE_CAROUSEL == $command->type;
    }
}
