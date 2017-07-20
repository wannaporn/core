<?php

namespace LineMob\Core;

use LineMob\Core\Command\AbstractCommand;

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
    public function add($commandClass, SenderHandlerInterface $handler, $default = false)
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
            $cmd = new $command(['input' => $input]);

            if ($cmd->supported($input->text)) {
                return $cmd;
            }
        }

        return new $this->defaultCommand(['input' => $input]);
    }
}
