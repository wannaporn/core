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
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;

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
        return new TemplateMessageBuilder(
            $this->altText,
            new ConfirmTemplateBuilder($this->title, $this->actions)
        );
    }

    /**
     * @param string $label
     * @param string $text
     */
    public function addLeftButtonAction($label = 'Yes', $text = 'yes')
    {
        $this->actions[] = new MessageTemplateActionBuilder($label, $text);
    }

    /**
     * @param string $label
     * @param string $text
     */
    public function addRightButtonAction($label = 'No', $text = 'no')
    {
        $this->actions[] = new MessageTemplateActionBuilder($label, $text);
    }
}
