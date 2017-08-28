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

use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class ButtonsTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $altText = 'This is buttons template.';

    /**
     * @var string
     */
    public $title = 'Menu';

    /**
     * @var string
     */
    public $text = 'Please select';

    /**
     * @var string
     */
    public $thumbnail;

    /**
     * @var array
     */
    public $actions = [];

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        $actions = [];

        foreach ($this->actions as $action) {
            switch (strtolower($action->type)) {
                case TemplateAction::TYPE_POSTBACK:
                    $actions[] = new PostbackTemplateActionBuilder($action->label, $action->value);
                    break;
                case TemplateAction::TYPE_URI:
                    $actions[] =  new UriTemplateActionBuilder($action->label, $action->value);
                    break;
                default:
                    $actions[] =  new MessageTemplateActionBuilder($action->label, $action->value);;
            }
        }

        return new TemplateMessageBuilder(
            $this->altText,
            new ButtonTemplateBuilder($this->title, $this->text, $this->thumbnail, $actions)
        );
    }

    /**
     * @param $text
     * @param $value
     * @param $type
     */
    public function addAction($text, $value, $type = TemplateAction::TYPE_MESSAGE)
    {
        $this->actions[] = new TemplateAction($text, $value, $type);
    }
}
