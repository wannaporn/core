<?php

namespace LineMob\Core\Message;

use LineMob\Core\Command\AbstractCommand;

class Factory implements FactoryInterface
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
                return $message->createTemplate($command);
            }
        }

        throw new \RuntimeException("Unsupported message type: ".$command->type);
    }
}
