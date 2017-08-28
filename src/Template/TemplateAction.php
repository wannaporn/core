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
     * @var string
     */
    public $label;

    /**
     * @param $label
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * @param string $value
     * @param string $type
     *
     * @return mixed
     */
    public function buildTemplateAction($value, $type = self::TYPE_MESSAGE)
    {
        switch ($type) {
            case self::TYPE_POSTBACK:
                return $this->createPostbackTemplateAction($value);
                break;
            case self::TYPE_URI:
                return $this->createUriTemplateAction($value);
                break;
            default:
                return $this->createMessageTemplateAction($value);
        }
    }

    /**
     * @param string $text
     *
     * @return MessageTemplateActionBuilder
     */
    private function createMessageTemplateAction($text)
    {
        return new MessageTemplateActionBuilder($this->label, $text);
    }

    /**
     * @param string $link
     *
     * @return UriTemplateActionBuilder
     */
    private function createUriTemplateAction($link)
    {
        return new UriTemplateActionBuilder($this->label, $link);
    }

    /**
     * @param string $data
     *
     * @return PostbackTemplateActionBuilder
     */
    private function createPostbackTemplateAction($data)
    {
        return new PostbackTemplateActionBuilder($this->label, $data);
    }
}
