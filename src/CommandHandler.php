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
use LineMob\Core\Factory\MessageFactoryInterface;
use LineMob\Core\Sender\SenderInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class CommandHandler implements CommandHandlerInterface
{
    /**
     * @var SenderInterface
     */
    protected $sender;

    /**
     * @var MessageFactoryInterface
     */
    protected $factory;

    /**
     * @param SenderInterface $sender
     * @param MessageFactoryInterface $factory
     */
    public function __construct(SenderInterface $sender, MessageFactoryInterface $factory)
    {
        $this->sender = $sender;
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(AbstractCommand $command)
    {
        $message = $this->factory->createMessage($command);

        switch ($command->mode) {
            case Constants::MODE_MULTICAST:
                $result = $this->sender->multicast($command->tos, $message);
                break;

            case Constants::MODE_PUSH:
                $result = $this->sender->pushMessage($command->to, $message);
                break;

            default:
                $result = $this->sender->replyMessage($command->input->replyToken, $message);
        }

        return $result;
    }
}
