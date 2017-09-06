<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template\ImageCarousel;

use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LineMob\Core\LineCorp\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LineMob\Core\LineCorp\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LineMob\Core\Template\AbstractTemplate;
use LineMob\Core\Template\Action;

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class ImageCarouselTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $altText = 'This is image carousel template.';

    /**
     * @var Item[]
     */
    public $items;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = new ImageCarouselColumnTemplateBuilder(
                $item->imageUrl,
                $this->createItemAction($item->action)
            );
        }

        return new TemplateMessageBuilder($this->altText, new ImageCarouselTemplateBuilder($items));
    }

    /**
     * @param string $imageUrl
     * @param Action $action
     */
    public function addItem($imageUrl, $action)
    {
        $this->items[] = new Item($imageUrl, $action);
    }

    /**
     * @param $action
     *
     * @return TemplateActionBuilder
     */
    private function createItemAction($action)
    {
        $label = mb_substr($action->label, 0, 12);

        switch (strtolower($action->type)) {
            case Action::TYPE_POSTBACK:
                return new PostbackTemplateActionBuilder($label, $action->value);
            case Action::TYPE_URI:
                return new UriTemplateActionBuilder($label, $action->value);
            default:
                return new MessageTemplateActionBuilder($label, $action->value);
        }
    }
}
