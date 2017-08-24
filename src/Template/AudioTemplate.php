<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;

class AudioTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var int
     */
    public $duration;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new AudioMessageBuilder($this->url, $this->duration);
    }
}
