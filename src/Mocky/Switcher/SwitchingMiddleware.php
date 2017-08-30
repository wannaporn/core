<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Mocky\Switcher;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\TextTemplate;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class SwitchingMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        $cmd = new SwitchedCommand();
        $cmd->message = new TextTemplate();
        $cmd->message->text = 'SwitchingMiddleware';
        $cmd->input = $command->input;

        $command['switchTo'] = $cmd;

        return $next($command);
    }
}
