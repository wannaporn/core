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

    /**
     * @param int $stickerId
     */
    public function createMoon($stickerId)
    {
        $this->packageId = 1;
        $this->stickerId = $stickerId;
    }

    /**
     * @param int $stickerId
     */
    public function createBrown($stickerId)
    {
        $this->packageId = 2;
        $this->stickerId = $stickerId;
    }

    /**
     * @param int $stickerId
     */
    public function createCherry($stickerId)
    {
        $this->packageId = 3;
        $this->stickerId = $stickerId;
    }

    /**
     * @param int $stickerId
     */
    public function createDaily($stickerId)
    {
        $this->packageId = 4;
        $this->stickerId = $stickerId;
    }
}
