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
