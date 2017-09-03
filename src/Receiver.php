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

use League\Tactician\CommandBus;
use LineMob\Core\Command\FallbackCommand;
use LineMob\Core\Exception\DerailException;
use LineMob\Core\Sender\SenderInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Receiver
{
    /**
     * @var SenderInterface
     */
    private $sender;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var CommandHandlerInterface
     */
    private $handler;

    public function __construct(
        SenderInterface $sender,
        RegistryInterface $registry,
        CommandBus $commandBus,
        CommandHandlerInterface $handler
    ) {
        $this->sender = $sender;
        $this->registry = $registry;
        $this->commandBus = $commandBus;
        $this->handler = $handler;
    }

    /**
     * @param $body
     * @param $signature
     *
     * @return bool
     */
    public function validate($body, $signature)
    {
        return $this->sender->validateSignature($body, $signature);
    }

    /**
     * @param array $eventData
     *
     * @return string
     */
    private function captureReceiveMessageText(array $eventData)
    {
        $type = strtolower(@$eventData['message']['type']);

        switch ($type) {
            case Constants::REVEIVE_TYPE_MESSAGE_TEXT:
                return @$eventData['message']['text'];

            default:
                throw new \RuntimeException("Unknown message type `$type`.");
        }
    }

    /**
     * @param array $eventData
     *
     * @return Input
     */
    private function captureInput(array $eventData)
    {
        $inputData = [
            'text' => FallbackCommand::CMD,
        ];

        if (empty($eventData['replyToken'])) {
            throw new \InvalidArgumentException("Require `replyToken` to run.");
        }

        if (empty($eventData['source']['userId'])) {
            throw new \InvalidArgumentException("Require `userId` to run.");
        }

        $inputData['replyToken'] = $eventData['replyToken'];
        $inputData['userId'] = $eventData['source']['userId'];
        $type = strtolower(@$eventData['type']);

        switch ($type) {
            case Constants::REVEIVE_TYPE_FOLLOW:
                $inputData['text'] = ':follow';
                break;

            case Constants::REVEIVE_TYPE_MESSAGE:
                $inputData['text'] = $this->captureReceiveMessageText($eventData);
                break;

            default:
                throw new \RuntimeException("Unsupported event type `$type`.");
        }

        return new Input($inputData);
    }

    /**
     * @param $payload
     *
     * @return array
     */
    public function handle($payload)
    {
        $data = json_decode($payload, true) ?: [];
        $events = (array)@$data['events'];
        $results = [];

        try {
            foreach ($events as $event) {
                $input = $this->captureInput($event);
                $command = $this->registry->findCommand($input);
                $command->input = $input;

                $results[] = $this->commandBus->handle($command);
            }
        } catch (DerailException $e) {
            $results[] = $this->handler->handle($e->command);
        } catch (\Exception $e) {
            $results[] = sprintf('ERROR: %s', $e->getMessage());
        }

        return $results;
    }
}
