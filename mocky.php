#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

$options = getopt("t:", []);

use LineMob\Core\Constants;
use LineMob\Core\Mocky\Setup;

\LineMob\Core\Mocky\Doctrine\Manager::get(true);

$results = Setup::authen(
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
                    'text' => $options['t'], // use `-t xxxxxx` in terminal
                ],
            ],
        ],
    ]
);

foreach ($results as $result) {
    if ($result instanceof \LINE\LINEBot\Response) {
        dump($result->getJSONDecodedBody());
    } else {
        dump($result);
    }
}
