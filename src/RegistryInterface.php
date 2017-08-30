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
interface RegistryInterface
{
    /**
     * @param string $commandClass
     * @param CommandHandlerInterface $handler
     *
     * @param bool $default
     */
    public function add($commandClass, CommandHandlerInterface $handler, $default = false);

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
