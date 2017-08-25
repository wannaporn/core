<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;

/**
 * @author WATCHDOGS <godoakbrutal@gmail.com>
 */
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
