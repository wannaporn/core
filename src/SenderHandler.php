<?php

namespace LineMob\Core;

use LINE\LINEBot;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Message\FactoryInterface;

class SenderHandler implements SenderHandlerInterface
{
    /**
     * @var LINEBot
     */
    protected $bot;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param LINEBot $bot
     * @param FactoryInterface $factory
     */
    public function __construct(LINEBot $bot, FactoryInterface $factory)
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
