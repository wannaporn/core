<?php

namespace LineMob\Core;

final class Constants
{
    const VERSION = '0.2.0';

    const TYPE_TEXT = 'text';
    const TYPE_STICKER = 'sticker';
    const TYPE_CAROUSEL = 'carousel';

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
