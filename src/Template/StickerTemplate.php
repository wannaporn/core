<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

class StickerTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $packageId;

    /**
     * @var string
     */
    public $stickerId;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new StickerMessageBuilder($this->packageId, $this->stickerId);
    }
}
