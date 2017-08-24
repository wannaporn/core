<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class ImageTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $previewUrl;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new ImageMessageBuilder($this->url, $this->previewUrl);
    }
}
