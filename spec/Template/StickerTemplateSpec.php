<?php

namespace spec\LineMob\Core\Template;

use LINE\LINEBot\Constant\MessageType;
use LineMob\Core\Template\StickerTemplate;
use PhpSpec\ObjectBehavior;

/**
 * @mixin StickerTemplate
 */
class StickerTemplateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StickerTemplate::class);
    }

    function it_should_build_sticker_message()
    {
        $this->packageId = $packageId = '1';
        $this->stickerId = $stickerId = '1';

        $this->getTemplate()->buildMessage()->shouldReturn(
            [
                [
                    'type' => MessageType::STICKER,
                    'packageId' => $packageId,
                    'stickerId' => $stickerId,
                ],
            ]
        );
    }
}
