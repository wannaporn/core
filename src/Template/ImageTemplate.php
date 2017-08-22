<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class ImageTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $originalUrl;

    /**
     * @var string
     */
    public $previewImageUrl;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new ImageMessageBuilder($this->originalUrl, $this->previewImageUrl);
    }
}
