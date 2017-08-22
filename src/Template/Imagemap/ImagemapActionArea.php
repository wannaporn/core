<?php

namespace LineMob\Core\Template\Imagemap;

use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;

class ImagemapActionArea
{
    /**
     * @var int
     */
    public $x;

    /**
     * @var int
     */
    public $y;

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    public function areaBuilder()
    {
        return new AreaBuilder($this->x, $this->y, $this->width, $this->height);
    }
}
