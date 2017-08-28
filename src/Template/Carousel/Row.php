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

use LineMob\Core\Template\TemplateAction;

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
     * @var TemplateAction[]
     */
    public $actions;

    public function __construct($title, $text, $thumbnail, array $actions = [])
    {
        $this->title = $title;
        $this->text = $text;
        $this->thumbnail = $thumbnail;

        foreach ($actions as $action) {
            if (!$action instanceof TemplateAction) {
                $action = new TemplateAction($action['label'], $action['value']);
            }

            $this->actions[] = $action;
        }
    }

    /**
     * @param $text
     * @param $value
     */
    public function addAction($text, $value)
    {
        $this->actions[] = new TemplateAction($text, $value);
    }
}
