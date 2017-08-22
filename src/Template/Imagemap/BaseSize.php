<?php

namespace LineMob\Core\Template\Imagemap;

class BaseSize
{
    /**
     * @var int
     */
    public $height;

    /**
     * @var int
     */
    public $width;

    function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }
}
