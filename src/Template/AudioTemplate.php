<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;

class AudioTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $audioUrl;

    /**
     * @var int
     */
    public $audioDuration;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new AudioMessageBuilder($this->audioUrl, $this->audioDuration);
    }
}
