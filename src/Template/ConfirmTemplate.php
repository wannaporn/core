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
    use ActionTemplateTrait;

    /**
     * @var string
     */
    public $altText = 'This is confirm template.';

    /**
     * @var string
     */
    public $title = 'Are You sure?';

    /**
     * @var Action[]
     */
    public $actions = [];

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new TemplateMessageBuilder($this->altText, new ConfirmTemplateBuilder(
            $this->title,
            $this->createActions($this->actions)
        ));
    }

    /**
     * @param string $label
     * @param string $text
     * @param string $type
     */
    public function addYesAction($label = 'Yes', $text = 'yes', $type = Action::TYPE_MESSAGE)
    {
        $this->actions[0] = new Action($label, $text, $type);
    }

    /**
     * @param string $label
     * @param string $text
     * @param string $type
     */
    public function addNoAction($label = 'No', $text = 'no', $type = Action::TYPE_MESSAGE)
    {
        $this->actions[1] = new Action($label, $text, $type);
    }
}
