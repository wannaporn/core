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

use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;

/**
 * @author WATCHDOGS <godoakbrutal@gmail.com>
 */
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
