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

use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Message\MessageInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class MessageFactory implements MessageFactoryInterface
{
    /**
     * @var MessageInterface[]
     */
    private $messages;

    public function __construct(array $messages = [])
    {
        $this->messages = $messages;
    }

    /**
     * {@inheritdoc}
     */
    public function add(MessageInterface $message)
    {
        $this->messages[] = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function createMessage(AbstractCommand $command)
    {
        foreach ($this->messages as $message) {
            if ($message->supported($command)) {
                return $message->createTemplate($command->message);
            }
        }

        throw new \RuntimeException("Unsupported message type: ".get_class($command->message));
    }
}
