<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
abstract class AbstractTemplate implements TemplateInterface
{
    final public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this;
    }
}
