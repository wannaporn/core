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

/**
 * @author WATCHDOGS <godoakbrutal@gmail.com>
 */
class Action
{
    const TYPE_MESSAGE = 'message';
    const TYPE_URI = 'uri';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string|null
     */
    public $text;

    /**
     * @var string|null
     */
    public $link;

    /**
     * @var ActionArea
     */
    public $area;

    /**
     * Action constructor.
     * @param ActionArea $area
     * @param string $type
     * @param string|null $text
     * @param string|null $link
     */
    public function __construct(ActionArea $area, $type, $text = null, $link = null)
    {
        $this->type = $type;
        $this->text = $text;
        $this->link = $link;
        $this->area = $area;
    }
}
