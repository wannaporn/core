<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;

class DummyStoragePersistMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if (!$command->storage) {
            throw new \RuntimeException("Require storage before using this middleware!");
        }

        $storage = $command->storage;
        $logs = $command->logs;

        // don't persist log
        unset($command->logs);

        // don't persist log
        unset($command->storage);

        // only persist raw data
        $storage->setLineCommandData((array) $command);

        // log for dump
        $command['logs'] = $logs;
        $command->logs = ['data' => (array) $storage->getLineCommandData()];

        // re-connect storage
        $command->storage = $storage;

        return $next($command);
    }
}
