<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template\ImageCarousel;

use LineMob\Core\Template\Action;

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class Item
{
    /**
     * @var string
     */
    public $imageUrl;

    /**
     * @var Action
     */
    public $action;

    /**
     * @param $imageUrl
     * @param $action
     */
    public function __construct($imageUrl, $action)
    {
        $this->imageUrl = $imageUrl;

        if (!$action instanceof Action) {
            throw new \InvalidArgumentException("`Action` should be typeof: ".Action::class);
        }

        $this->action = $action;
    }
}
