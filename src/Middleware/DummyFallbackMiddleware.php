<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Command\FallbackCommand;
use LineMob\Core\Storage\CommandStorage;

class DummyFallbackMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if ($command instanceof FallbackCommand) {
            $command->message = "Oops! I dont know wath you say.";
        }

        return $next($command);
    }
}
