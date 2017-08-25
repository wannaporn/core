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

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Row
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
     * @var RowAction[]
     */
    public $actions;

    public function __construct($title, $text, $thumbnail, array $actions = [])
    {
        $this->label = $title;
        $this->text = $text;
        $this->thumbnail = $thumbnail;

        foreach ($actions as $action) {
            if (!$action instanceof RowAction) {
                $action = new RowAction($action['label'], $action['link']);
            }

            $this->actions[] = $action;
        }
    }

    /**
     * @param $text
     * @param $link
     */
    public function addAction($text, $link)
    {
        $this->actions[] = new RowAction($text, $link);
    }
}
