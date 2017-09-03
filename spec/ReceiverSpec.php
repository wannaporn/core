<?php

namespace spec\LineMob\Core;

use League\Tactician\CommandBus;
use LineMob\Core\Command\FallbackCommand;
use LineMob\Core\Constants;
use LineMob\Core\Input;
use LineMob\Core\Receiver;
use LineMob\Core\RegistryInterface;
use LineMob\Core\CommandHandlerInterface;
use LineMob\Core\Sender\SenderInterface;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Receiver
 */
class ReceiverSpec extends ObjectBehavior
{
    function let(SenderInterface $sender, RegistryInterface $registry, CommandBus $bus, CommandHandlerInterface $handler)
    {
        $this->beConstructedWith($sender, $registry, $bus, $handler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Receiver::class);
    }

    private function mockEventData(array $data)
    {
        return json_encode(
            [
                'events' => [$data],
            ]
        );
    }

    function it_do_nothing_when_handle_empty_playload()
    {
        $this->handle('')->shouldReturn([]);
    }

    function it_should_fail_when_not_have_user_id()
    {
        $data = $this->mockEventData(
            [
                'source' => [],
                'replyToken' => 'foo',
            ]
        );

        $this->handle($data)->shouldReturn(
            [
                'ERROR: Require `userId` to run.',
            ]
        );
    }

    function it_should_fail_when_not_have_reply_token()
    {
        $data = $this->mockEventData(
            [
                'source' => [
                    'userId' => 'foo',
                ],
            ]
        );

        $this->handle($data)->shouldReturn(
            [
                'ERROR: Require `replyToken` to run.',
            ]
        );
    }

    function it_should_fail_when_got_unknown_type()
    {
        $data = $this->mockEventData(
            [
                'replyToken' => 'foo',
                'source' => [
                    'userId' => 'bar',
                ],
            ]
        );

        $this->handle($data)->shouldReturn(
            [
                'ERROR: Unsupported event type ``.',
            ]
        );
    }

    function it_capture_follow_receive_message_type(RegistryInterface $registry)
    {
        $data = $this->mockEventData(
            [
                'type' => Constants::REVEIVE_TYPE_FOLLOW,
                'replyToken' => 'foo',
                'source' => [
                    'userId' => 'bar',
                ],
            ]
        );

        $registry->findCommand(
            new Input(
                [
                    'replyToken' => 'foo',
                    'userId' => 'bar',
                    'text' => ':follow',
                ]
            )
        )->willReturn(new FallbackCommand());

        $this->handle($data)->shouldReturn([null]);
    }

    function it_fail_when_unknown_receive_message_type(RegistryInterface $registry)
    {
        $data = $this->mockEventData(
            [
                'type' => Constants::REVEIVE_TYPE_MESSAGE,
                'replyToken' => 'foo',
                'source' => [
                    'userId' => 'bar',
                ],
            ]
        );

        $this->handle($data)->shouldReturn(
            [
                'ERROR: Unknown message type ``.',
            ]
        );
    }

    function it_will_handle_some_command_when_knowing_receive_message_type(RegistryInterface $registry, CommandBus $commandBus)
    {
        $data = $this->mockEventData(
            [
                'type' => Constants::REVEIVE_TYPE_MESSAGE,
                'replyToken' => 'foo',
                'source' => [
                    'userId' => 'bar',
                ],
                'message' => [
                    'type' => Constants::REVEIVE_TYPE_MESSAGE_TEXT,
                ],
            ]
        );

        $command = $registry->findCommand(
            new Input(
                [
                    'replyToken' => 'foo',
                    'userId' => 'bar',
                    'text' => '',
                ]
            )
        )->willReturn(new FallbackCommand());

        $commandBus->handle($command)->willReturn(null);

        $this->handle($data)->shouldReturn([null]);
    }
}
