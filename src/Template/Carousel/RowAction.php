<?php

namespace LineMob\Core\Template\Carousel;

class RowAction
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $link;

    public function __construct($label, $link)
    {
        $this->label = $label;
        $this->link = $link;
    }
}
