<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Storage\CommandStorage;

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
        $command->storage = $storage = new CommandStorage();
        $command->active = $storage->getLineActivedCmd();

        $command->merge($storage->getLineCommandData());

        $storage->setLineUserId($command->input->userId);

        return $next($command);
    }
}
