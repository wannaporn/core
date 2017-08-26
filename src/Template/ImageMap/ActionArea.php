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

use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;

/**
 * @author WATCHDOGS <godoakbrutal@gmail.com>
 */
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

    /**
     * ActionArea constructor.
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     */
    public function __construct($x, $y, $width, $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return AreaBuilder
     */
    public function getArea()
    {
        return new AreaBuilder($this->x, $this->y, $this->width, $this->height);
    }
}
