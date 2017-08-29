<?php

namespace spec\LineMob\Core;

use LineMob\Core\Input;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Input
 */
class InputSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(['text' => 'foo']);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Input::class);
    }

    public function it_can_be_string()
    {
        $this->__toString()->shouldBe('foo');
    }

    public function it_be_frozen()
    {
        $this
            ->shouldThrow(new \LogicException('Impossible to set on a frozen input.'))
            ->during('__set', ['text', 'bar']);
    }
}
