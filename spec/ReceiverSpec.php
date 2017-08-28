<?php

namespace spec\LineMob\Core;

use League\Tactician\CommandBus;
use LineMob\Core\LineBot;
use LineMob\Core\Receiver;
use LineMob\Core\RegistryInterface;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Receiver
 */
class ReceiverSpec extends ObjectBehavior
{
    function let(LineBot $bot, RegistryInterface $registry, CommandBus $bus)
    {
        $this->beConstructedWith($bot, $registry, $bus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Receiver::class);
    }

    function it_do_nothing_when_handle_empty_playload()
    {
        $this->handle('')->shouldReturn([]);
    }

    function it_should_fail_runtime_when_not_have_user_id()
    {
        $data = json_encode(
            [
                'events' => [
                    'source' => [],
                ],
            ]
        );

        $this->shouldThrow(new \RuntimeException("Require `userId` to run."))
            ->during('handle', [$data]);
    }
}
