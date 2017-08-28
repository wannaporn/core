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

use LineMob\Core\Template\TemplateAction;

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
    public $value;

    /**
     * @var string
     */
    public $type;

    public function __construct($label, $value, $type = TemplateAction::TYPE_MESSAGE)
    {
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }
}
