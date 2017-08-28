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
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LineMob\Core\Template\AbstractTemplate;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class CarouselTemplate extends AbstractTemplate
{
    /**
     * @var Row[]
     */
    public $rows;

    /**
     * @var string
     */
    public $altText = 'This is carousel template.';

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $rows = [];

        foreach ($this->rows as $row) {
            $actions = [];

            foreach ($row->actions as $action) {
                $actions[] = new UriTemplateActionBuilder($action->label, $action->link);
            }

            $rows[] = new CarouselColumnTemplateBuilder(
                mb_substr($row->title, 0, 40), mb_substr($row->text, 0, 60),
                $row->thumbnail,
                $actions
            );
        }

        return new TemplateMessageBuilder($this->altText, new CarouselTemplateBuilder($rows));
    }

    /**
     * @param string $title
     * @param string $text
     * @param string $thumbnail
     * @param [{'label', 'link'}]|RowAction[] $actions
     */
    public function addRow($title, $text, $thumbnail, array $actions = [])
    {
        $this->rows[] = new Row($title, $text, $thumbnail, $actions);
    }
}
