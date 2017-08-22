<?php

namespace LineMob\Core\Template\Imagemap;

use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LineMob\Core\Template\AbstractTemplate;

class ImagemapTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $baseUrl;

    /**
     * @var string
     */
    public $altText = 'this is an imagemap';

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * @var Action[]
     */
    public $actions;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $baseSizeBuilder = new BaseSizeBuilder($this->height, $this->width);

        $actionBuilders = [];

        foreach ($this->actions as $action) {
            if ($action->type == 'uri') {
                $actionBuilders[] = new ImagemapUriActionBuilder($action->link, $action->area->getAreaBuilder());
            }

            if ($action->type == 'message') {
                $actionBuilders[] = new ImagemapMessageActionBuilder($action->text, $action->area->getAreaBuilder());
            }
        }

        return new ImagemapMessageBuilder($this->baseUrl, $this->altText, $baseSizeBuilder, $actionBuilders);
    }
}
