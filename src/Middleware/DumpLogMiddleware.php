<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;

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
            dump($command->logs);
        }

        return $next($command);
    }
}
