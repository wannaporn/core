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
use LineMob\Core\Storage\CommandData;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class DummyStorageConnectMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        // should find from real storage eg. mysql
        $command->storage = $storage = new CommandData();
        $command->merge($storage->getLineCommandData());

        $storage->setLineUserId($command->input->userId);
        $storage->setLineActiveCmd($command->getCmd());

        return $next($command);
    }
}
