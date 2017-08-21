<?php

namespace LineMob\Core\Template\Carousel;

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
