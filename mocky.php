#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

use LineMob\Core\Constants;
use LineMob\Core\Mocky\Setup;

$result = Setup::switching(
    [
        'events' => [
            [
                'type' => Constants::REVEIVE_TYPE_MESSAGE,
                'replyToken' => 'mock:replyToken',
                'source' => [
                    'userId' => 'mock:userId',
                ],
                'message' => [
                    'type' => Constants::REVEIVE_TYPE_MESSAGE_TEXT,
                ],
            ],
        ],
    ]
);

dump($result);
