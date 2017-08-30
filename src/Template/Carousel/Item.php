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

use LineMob\Core\Template\Action;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Item
{
    /**
     * @var string
     */
    public $thumbnail;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $title;

    /**
     * @var Action[]
     */
    public $actions;

    public function __construct($title, $text, $thumbnail, array $actions = [])
    {
        $this->title = $title;
        $this->text = $text;
        $this->thumbnail = $thumbnail;

        foreach ($actions as $action) {
            if (!$action instanceof Action) {
                throw new \InvalidArgumentException("`Action` should be typeof: ".Action::class);
            }

            $this->actions[] = $action;
        }
    }

    /**
     * @param $label
     * @param $text
     */
    public function addMessageAction($label, $text)
    {
        $this->actions[] = new Action($label, $text, Action::TYPE_MESSAGE);
    }

    /**
     * @param $label
     * @param $link
     */
    public function addUriAction($label, $link)
    {
        $this->actions[] = new Action($label, $link, Action::TYPE_URI);
    }

    /**
     * @param $label
     * @param $data
     */
    public function addPostbackAction($label, $data)
    {
        $this->actions[] = new Action($label, $data, Action::TYPE_POSTBACK);
    }
}
