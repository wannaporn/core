<?php

namespace LineMob\Core;

use League\Tactician\CommandBus;
use LineMob\Core\Command\FallbackCommand;

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
            $input = [];
            $input['replyToken'] = @$event['replyToken'];
            $input['userId'] = @$event['source']['userId'];

            if (!$input['userId']) {
                throw new \RuntimeException("Require `userId` to run.");
            }

            if (Constants::REVEIVE_TYPE_FOLLOW === @$event['type']) {
                $input['text'] = ':follow';
            }

            if (Constants::REVEIVE_TYPE_MESSAGE === @$event['type']) {
                if (Constants::REVEIVE_TYPE_MESSAGE_TEXT === @$event['message']['type']) {
                    $input['text'] = @$event['message']['text'];
                }

                // TODO: support other type
            }

            if (!$input['text']) {
                $input['text'] = FallbackCommand::CMD;
            }

            try {
                $results[] = $this->commandBus->handle(
                    $this->registry->findCommand(new Input($input))
                );
            } catch (\Exception $e) {
                $results[] = sprintf('ERROR: %s', $e->getMessage());
            }
        }

        return $results;
    }
}
