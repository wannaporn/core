<?php

namespace LineMob\Core\Template;

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class Action
{
    const TYPE_MESSAGE = 'message';
    const TYPE_URI = 'uri';
    const TYPE_POSTBACK = 'postback';

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $type;

    /**
     * @param $label
     * @param $value
     * @param string $type
     */
    public function __construct($label, $value, $type = self::TYPE_MESSAGE)
    {
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }
}
