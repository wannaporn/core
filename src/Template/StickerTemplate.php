<?php

/**
 * Copyright 2017 Intelligence Business (Thailand) Co.,Ltd.
 */

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

/**
 * @author Taned Suparpornhemin <taned@intbizth.com>
 */
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
     * @return StickerTemplate
     */
    public static function createMoon($stickerId)
    {
        $self = new self();
        $self->packageId = 1;
        $self->stickerId = $stickerId;

        return $self;
    }

    /**
     * @param int $stickerId
     * @return StickerTemplate
     */
    public static function createBrown($stickerId)
    {
        $self = new self();
        $self->packageId = 2;
        $self->stickerId = $stickerId;

        return $self;
    }

    /**
     * @param int $stickerId
     * @return StickerTemplate
     */
    public static function createCherry($stickerId)
    {
        $self = new self();
        $self->packageId = 3;
        $self->stickerId = $stickerId;

        return $self;
    }

    /**
     * @param int $stickerId
     * @return StickerTemplate
     */
    public static function createDaily($stickerId)
    {
        $self = new self();
        $self->packageId = 4;
        $self->stickerId = $stickerId;

        return $self;
    }
}
