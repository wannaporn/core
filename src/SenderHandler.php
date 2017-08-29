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

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class SenderHandler implements SenderHandlerInterface
{
    /**
     * @var LineBot
     */
    protected $bot;

    /**
     * @var MessageFactoryInterface
     */
    protected $factory;

    /**
     * @param LineBot $bot
     * @param MessageFactoryInterface $factory
     */
    public function __construct(LineBot $bot, MessageFactoryInterface $factory)
    {
        $this->bot = $bot;
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
                $result = $this->bot->multicast($command->tos, $message);
                break;

            case Constants::MODE_PUSH:
                $result = $this->bot->pushMessage($command->to, $message);
                break;

            default:
                $result = $this->bot->replyMessage($command->input->replyToken, $message);
        }

        return $result;
    }
}
