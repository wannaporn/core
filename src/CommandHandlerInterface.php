<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core;

use LineMob\Core\Command\AbstractCommand;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface CommandHandlerInterface
{
    /**
     * @param AbstractCommand $command
     *
     * @return mixed
     */
    public function handle(AbstractCommand $command);
}
