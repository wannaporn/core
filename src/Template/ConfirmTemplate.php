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

use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class ConfirmTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    public $altText = 'This is confirm template.';

    /**
     * @var string
     */
    public $title = 'Are You sure?';

    /**
     * @var array
     */
    public $actions = [];

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        ksort($this->actions);

        return new TemplateMessageBuilder(
            $this->altText,
            new ConfirmTemplateBuilder($this->title, $this->actions)
        );
    }

    /**
     * @param string $label
     * @param string $text
     * @param string $type
     */
    public function addLeftButtonAction($label = 'Yes', $text = 'yes', $type = TemplateAction::TYPE_MESSAGE)
    {
        $templateAction = new TemplateAction($label);
        $this->actions[0] = $templateAction->buildTemplateAction($text, $type);
    }

    /**
     * @param string $label
     * @param string $text
     * @param string $type
     */
    public function addRightButtonAction($label = 'No', $text = 'no', $type = TemplateAction::TYPE_MESSAGE)
    {
        $templateAction = new TemplateAction($label);
        $this->actions[1] = $templateAction->buildTemplateAction($text, $type);
    }
}
