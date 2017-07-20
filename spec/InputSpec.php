<?php

namespace spec\LineMob\Core;

use LineMob\Core\Input;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Input
 */
class InputSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Input::class);
    }

    function it_can_be_string()
    {
        $this->text = 'foo';
        $this->__toString()->shouldBe('foo');
    }

    function it_be_serializable()
    {
        $this->text = 'foo';
        $this->userId = 'bar';

        $this->serialize()->shouldReturn(serialize([
            'text' => 'foo',
            'userId' => 'bar',
            'replyToken' => null,
        ]));
    }

    function it_be_unserializable()
    {
        $this->unserialize(serialize([
            'text' => 'foo',
            'userId' => null,
            'replyToken' => null,
        ]));

        $this->__toString()->shouldBe('foo');
    }
}
