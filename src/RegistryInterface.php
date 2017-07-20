<?php

namespace LineMob\Core;

use LineMob\Core\Command\AbstractCommand;

interface RegistryInterface
{
    /**
     * @param string $commandClass
     * @param SenderHandlerInterface $handler
     *
     * @param bool $default
     */
    public function add($commandClass, SenderHandlerInterface $handler, $default = false);

    /**
     * @param Input $input
     *
     * @return AbstractCommand
     */
    public function findCommand(Input $input);

    /**
     * @return array
     */
    public function getCommandList();
}
