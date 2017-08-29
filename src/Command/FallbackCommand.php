<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Command;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class FallbackCommand extends AbstractCommand
{
    const CMD = '';

    /**
     * @var string
     */
    protected $cmd = self::CMD;
}
