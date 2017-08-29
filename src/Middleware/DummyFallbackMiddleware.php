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
use LineMob\Core\Command\FallbackCommand;
use LineMob\Core\Storage\CommandData;
use LineMob\Core\Template\TextTemplate;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
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
            $command->message = new TextTemplate();
            $command->message->text = "Oops! I dont know wath you say.";
        }

        return $next($command);
    }
}
