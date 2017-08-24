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

    public static function createMoon($stickerId)
    {
        return new self(1, $stickerId);
    }

    public function createBrown($stickerId)
    {
        return new self(2, $stickerId);
    }

    public function createCherry($stickerId)
    {
        return new self(3, $stickerId);
    }

    public function createDaily($stickerId)
    {
        return new self(4, $stickerId);
    }
}
