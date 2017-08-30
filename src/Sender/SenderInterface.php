<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Sender;

use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\Response;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface SenderInterface
{
    /**
     * Gets specified user's profile through API calling.
     *
     * @param string $userId The user ID to retrieve profile.
     * @return Response
     */
    public function getProfile($userId);

    /**
     * Replies arbitrary message to destination which is associated with reply token.
     *
     * @param string $replyToken Identifier of destination.
     * @param MessageBuilder $messageBuilder Message builder to send.
     * @return Response
     */
    public function replyMessage($replyToken, MessageBuilder $messageBuilder);

    /**
     * Replies text message(s) to destination which is associated with reply token.
     *
     * This method receives variable texts. It can send text(s) message as bulk.
     *
     * Exact signature of this method is <code>replyText(string $replyToken, string $text, string[] $extraTexts)</code>.
     *
     * Means, this method can also receive multiple texts like so;
     *
     * <code>
     * $bot->replyText('reply-text', 'text', 'extra text1', 'extra text2', ...)
     * </code>
     *
     * @param string $replyToken Identifier of destination.
     * @param string $text Text of message.
     * @param string[]|null $extraTexts Extra text of message.
     * @return Response
     */
    public function replyText($replyToken, $text, $extraTexts = null);

    /**
     * Sends arbitrary message to destination.
     *
     * @param string $to Identifier of destination.
     * @param MessageBuilder $messageBuilder Message builder to send.
     * @return Response
     */
    public function pushMessage($to, MessageBuilder $messageBuilder);

    /**
     * Sends arbitrary message to multi destinations.
     *
     * @param array $tos Identifiers of destination.
     * @param MessageBuilder $messageBuilder Message builder to send.
     * @return Response
     */
    public function multicast(array $tos, MessageBuilder $messageBuilder);

    /**
     * Leaves from group.
     *
     * @param string $groupId Identifier of group to leave.
     * @return Response
     */
    public function leaveGroup($groupId);

    /**
     * Leaves from room.
     *
     * @param string $roomId Identifier of room to leave.
     * @return Response
     */
    public function leaveRoom($roomId);

    /**
     * Validate request with signature.
     *
     * @param string $body Request body.
     * @param string $signature Signature of request.
     * @return bool Request is valid or not.
     */
    public function validateSignature($body, $signature);
}
