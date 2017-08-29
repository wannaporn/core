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
use LineMob\Core\Exception\InterruptException;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Receiver
{
    /**
     * @var LineBot
     */
    private $bot;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var RegistryInterface
     */
    private $registry;

    public function __construct(LineBot $bot, RegistryInterface $registry, CommandBus $commandBus)
    {
        $this->bot = $bot;
        $this->registry = $registry;
        $this->commandBus = $commandBus;
    }

    /**
     * @param $body
     * @param $signature
     *
     * @return bool
     */
    public function validate($body, $signature)
    {
        return $this->bot->validateSignature($body, $signature);
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

        foreach ($events as $event) {
            $inputData = [];
            $inputData['replyToken'] = @$event['replyToken'];
            $inputData['userId'] = @$event['source']['userId'];

            if (!$inputData['userId']) {
                throw new \RuntimeException("Require `userId` to run.");
            }

            if (Constants::REVEIVE_TYPE_FOLLOW === @$event['type']) {
                $inputData['text'] = ':follow';
            }

            if (Constants::REVEIVE_TYPE_MESSAGE === @$event['type']) {
                if (Constants::REVEIVE_TYPE_MESSAGE_TEXT === @$event['message']['type']) {
                    $inputData['text'] = @$event['message']['text'];
                }

                // TODO: support other type
            }

            if (!$inputData['text']) {
                $inputData['text'] = FallbackCommand::CMD;
            }

            try {
                $input = new Input($inputData);
                $command = $this->registry->findCommand($input);
                $command->input = $input;

                $results[] = $this->commandBus->handle($command);
            } catch (InterruptException $e) {
                // TODO: handle
            } catch (\Exception $e) {
                $results[] = sprintf('ERROR: %s', $e->getMessage());
            }
        }

        return $results;
    }
}
