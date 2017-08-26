<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template\ImageMap;

use LINE\LINEBot\ImageMapActionBuilder\ImageMapMessageActionBuilder;
use LINE\LINEBot\ImageMapActionBuilder\ImageMapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\ImageMap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImageMapMessageBuilder;
use LineMob\Core\Template\AbstractTemplate;

/**
 * @author WATCHDOGS <godoakbrutal@gmail.com>
 */
class ImageMapTemplate extends AbstractTemplate
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
                case Action::TYPE_URI:
                    $actions[] = new ImageMapUriActionBuilder($action->link, $action->area->getArea());
                    break;
                case Action::TYPE_MESSAGE:
                    $actions[] = new ImageMapMessageActionBuilder($action->text, $action->area->getArea());
                    break;
            }
        }

        return new ImageMapMessageBuilder($this->baseUrl, $this->altText, $baseSize, $actions);
    }

    /**
     * @param ActionArea $area
     * @param string $link
     */
    public function addLinkAction($link, ActionArea $area)
    {
        $this->actions[] = new Action($area, Action::TYPE_URI, null, $link);
    }

    /**
     * @param ActionArea $area
     * @param string $text
     */
    public function addMessageAction($text, ActionArea $area)
    {
        $this->actions[] = new Action($area, Action::TYPE_MESSAGE, $text, null);
    }
}
