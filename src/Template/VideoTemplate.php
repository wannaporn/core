<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;

class VideoTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $videoUrl;

    /**
     * @var string
     */
    public $videoPosterUrl;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new VideoMessageBuilder($this->videoUrl, $this->videoPosterUrl);
    }
}
