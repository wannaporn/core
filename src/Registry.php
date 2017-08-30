<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core;

use LineMob\Core\Command\AbstractCommand;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Registry implements RegistryInterface
{
    /**
     * @var array
     */
    private $commands = [];

    /**
     * @var string
     */
    private $defaultCommand;

    /**
     * {@inheritdoc}
     */
    public function add($commandClass, CommandHandlerInterface $handler, $default = false)
    {
        $this->commands[$commandClass] = $handler;

        if ($default) {
            $this->defaultCommand = $commandClass;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandList()
    {
        return $this->commands;
    }

    /**
     * {@inheritdoc}
     */
    public function findCommand(Input $input)
    {
        foreach (array_keys($this->commands) as $command) {
            /** @var AbstractCommand $cmd */
            $cmd = new $command();

            if ($cmd->supported($input->text)) {
                return $cmd;
            }
        }

        $cmd = new $this->defaultCommand();

        return $cmd;
    }
}
