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

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
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
