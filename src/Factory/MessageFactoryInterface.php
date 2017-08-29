<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Factory;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Message\MessageInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface MessageFactoryInterface
{
    /**
     * @param MessageInterface $message
     */
    public function add(MessageInterface $message);

    /**
     * @param AbstractCommand $command
     *
     * @return MessageBuilder
     * @throws  \RuntimeException
     */
    public function createMessage(AbstractCommand $command);
}
