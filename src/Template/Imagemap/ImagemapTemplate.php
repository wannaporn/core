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
    protected $baseUrl;

    /**
     * @var string
     */
    protected $altText = 'this is an imagemap';

    /**
     * @var BaseSize
     */
    protected $baseSize;

    /**
     * @var ImagemapAction[]
     */
    protected $actions;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $baseUrl = $this->baseUrl;
        $altText = $this->altText;

        $baseSizeHeight = $this->baseSize->height;
        $baseSizeWidth = $this->baseSize->width;
        $baseSizeBuilder = new BaseSizeBuilder($baseSizeHeight, $baseSizeWidth);

        $imageMapActions = [];

        foreach ($this->actions as $action) {
            if ($action->type == 'uri') {
                $link = $action->link;
                $area = $action->area;
                $area = $area->areaBuilder();

                $imageMapActions[] = new ImagemapUriActionBuilder($link, $area);
            }

            if ($action->type == 'message') {
                $message = $action->text;
                $area = $action->area;
                $area = $area->areaBuilder();

                $imageMapActions[] = new ImagemapMessageActionBuilder($message, $area);
            }
        }

        return new ImagemapMessageBuilder($baseUrl, $altText, $baseSizeBuilder, $imageMapActions);
    }
}
