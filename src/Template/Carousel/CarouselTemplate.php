<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace LineMob\Core\Template\Carousel;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LineMob\Core\Template\AbstractTemplate;
use LineMob\Core\Template\Action;
use LineMob\Core\Template\ActionTemplateTrait;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class CarouselTemplate extends AbstractTemplate
{
    use ActionTemplateTrait;

    /**
     * @var Item[]
     */
    public $items;

    /**
     * @var string
     */
    public $altText = 'This is carousel template.';

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = new CarouselColumnTemplateBuilder(
                mb_substr($item->title, 0, 40), mb_substr($item->text, 0, 60),
                $item->thumbnail,
                $this->createActions($item->actions)
            );
        }

        return new TemplateMessageBuilder($this->altText, new CarouselTemplateBuilder($items));
    }

    /**
     * @param string $title
     * @param string $text
     * @param string $thumbnail
     * @param array|Action[] $actions
     */
    public function addItem($title, $text, $thumbnail, array $actions = [])
    {
        $this->items[] = new Item($title, $text, $thumbnail, $actions);
    }
}
