<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;

class StoreActiveCmdMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if ($command->active) {
            if (!$command->storage) {
                throw new \RuntimeException("Require storage before using this middleware!");
            }

            $command->storage->setLineActivedCmd($command->cmd);
        }

        return $next($command);
    }
}
