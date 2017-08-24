<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;

class VideoTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $posterUrl;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new VideoMessageBuilder($this->url, $this->posterUrl);
    }
}
