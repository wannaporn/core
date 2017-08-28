<?php

namespace LineMob\Core\Template;

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class TemplateAction
{
    const TYPE_MESSAGE = 'message';
    const TYPE_URI = 'uri';
    const TYPE_POSTBACK = 'postback';

    /**
     * @param string $label
     * @param string $value
     * @param string $type
     *
     * @return mixed
     */
    public function buildTemplateAction($label, $value, $type = self::TYPE_MESSAGE)
    {
        switch ($type) {
            case self::TYPE_POSTBACK:
                return $this->createPostbackTemplateAction($label, $value);
                break;
            case self::TYPE_URI:
                return $this->createUriTemplateAction($label, $value);
                break;
            default:
                return $this->createMessageTemplateAction($label, $value);
        }
    }

    /**
     * @param string $label
     * @param string $text
     *
     * @return MessageTemplateActionBuilder
     */
    private function createMessageTemplateAction($label, $text)
    {
        return new MessageTemplateActionBuilder($label, $text);
    }

    /**
     * @param string $label
     * @param string $link
     *
     * @return UriTemplateActionBuilder
     */
    private function createUriTemplateAction($label, $link)
    {
        return new UriTemplateActionBuilder($label, $link);
    }

    /**
     * @param string $label
     * @param string $data
     *
     * @return PostbackTemplateActionBuilder
     */
    private function createPostbackTemplateAction($label, $data)
    {
        return new PostbackTemplateActionBuilder($label, $data);
    }
}
