<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class ClearActiveCmdMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        $command->active = false;

        return $next($command);
    }
}
