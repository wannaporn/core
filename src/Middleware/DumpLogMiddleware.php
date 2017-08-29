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
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class DumpLogMiddleware implements Middleware
{
    private $isDebug;

    public function __construct($isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        // dev only
        if ($this->isDebug && $command->logs) {
            VarDumper::dump($command->logs);
        }

        return $next($command);
    }
}
