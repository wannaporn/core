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
        $baseSize = new BaseSizeBuilder($this->height, $this->width);
        $actions = [];

        foreach ($this->actions as $action) {
            switch ($action->type) {
                case Action::TYPE_URI;
                    $actions[] = new ImagemapUriActionBuilder($action->link, $action->area->getArea());
                    break;

                case Action::TYPE_MESSAGE;
                    $actions[] = new ImagemapMessageActionBuilder($action->text, $action->area->getArea());
                    break;
            }
        }

        return new ImagemapMessageBuilder($this->baseUrl, $this->altText, $baseSize, $actions);
    }

    /**
     * @param ActionArea $area
     * @param string $type
     * @param string|null $text
     * @param string|null $link
     */
    public function addAction(ActionArea $area, $type, $text = null, $link = null)
    {
        $this->actions[] = new  Action($area, $type, $text, $link);
    }

    /**
     * @param ActionArea $area
     * @param $link
     */
    public function addLinkAction(ActionArea $area, $link)
    {
        $this->actions[] = new Action($area, Action::TYPE_URI, null, $link);
    }

    /**
     * @param ActionArea $area
     * @param $text
     */
    public function addMessageAction(ActionArea $area, $text)
    {
        $this->actions[] = new Action($area, Action::TYPE_MESSAGE, $text, null);
    }
}
