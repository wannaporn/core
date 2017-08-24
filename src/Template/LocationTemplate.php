<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;

class LocationTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $address;

    /**
     * @var int
     */
    public $latitude;

    /**
     * @var int
     */
    public $longitude;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new LocationMessageBuilder($this->title, $this->address, $this->latitude, $this->longitude);
    }
}
