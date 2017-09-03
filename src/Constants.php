<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
final class Constants
{
    const VERSION = '0.3.0';

    const TYPE_TEXT = 'text';
    const TYPE_STICKER = 'sticker';
    const TYPE_CAROUSEL = 'carousel';
    const TYPE_IMAGE = 'image';
    const TYPE_IMAGE_MAP = 'image_map';

    const MODE_REPLY = 'reply';
    const MODE_PUSH = 'push';
    const MODE_MULTICAST = 'multicast';

    const REVEIVE_TYPE_MESSAGE = 'message';
    const REVEIVE_TYPE_STICKER = 'sticker';
    const REVEIVE_TYPE_FOLLOW = 'follow';
    const REVEIVE_TYPE_MESSAGE_TEXT = 'text';

    public function __construct()
    {
    }
}
