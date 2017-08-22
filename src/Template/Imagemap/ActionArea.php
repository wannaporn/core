<?php

namespace LineMob\Core\Template\Imagemap;

use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;

class ActionArea
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

    public function getAreaBuilder()
    {
        return new AreaBuilder($this->x, $this->y, $this->width, $this->height);
    }
}
