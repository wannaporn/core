<?php

namespace spec\LineMob\Core\Template;

use LINE\LINEBot\Constant\MessageType;
use LineMob\Core\Template\VideoTemplate;
use PhpSpec\ObjectBehavior;

/**
 * @mixin VideoTemplate
 */
class VideoTemplateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(VideoTemplate::class);
    }

    function it_should_build_video_message()
    {
        $this->url = $url = 'https://www.w3schools.com/html/mov_bbb.mp4';
        $this->posterUrl = $posterUrl = 'https://img.youtube.com/vi/MZ2tq0F8-ww/3.jpg';

        $this->getTemplate()->buildMessage()->shouldReturn(
            [
                [
                    'type' => MessageType::VIDEO,
                    'originalContentUrl' => $url,
                    'previewImageUrl' => $posterUrl,
                ],
            ]
        );
    }
}
