<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Mocky;

use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\Response;
use LineMob\Core\Sender\SenderInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Sender implements SenderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getProfile($userId)
    {
        return new Response(200, json_encode([
            '$userId' => $userId,
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function replyMessage($replyToken, MessageBuilder $messageBuilder)
    {
        return new Response(200, json_encode([
            '$replyToken' => $replyToken,
            '$messageBuilder' => $messageBuilder->buildMessage(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function replyText($replyToken, $text, $extraTexts = null)
    {
        return new Response(200, json_encode([
            '$replyToken' => $replyToken,
            '$text' => $text,
            '$extraTexts' => $extraTexts,
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function pushMessage($to, MessageBuilder $messageBuilder)
    {
        return new Response(200, json_encode([
            '$to' => $to,
            '$messageBuilder' => $messageBuilder->buildMessage(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function multicast(array $tos, MessageBuilder $messageBuilder)
    {
        return new Response(200, json_encode([
            '$tos' => $tos,
            '$messageBuilder' => $messageBuilder->buildMessage(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function leaveGroup($groupId)
    {
        return new Response(200, json_encode([
            '$groupId' => $groupId,
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function leaveRoom($roomId)
    {
        return new Response(200, json_encode([
            '$roomId' => $roomId,
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function validateSignature($body, $signature)
    {
        return new Response(200, json_encode([
            '$body' => $body,
            '$signature' => $signature,
        ]));
    }
}
