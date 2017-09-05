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

/**
 * @author YokYukYik <yokyukyik.su@gmail.com>
 */
class ButtonsTemplate extends AbstractTemplate
{
    use ActionTemplateTrait;

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
     * @var Action[]
     */
    public $actions = [];

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return new TemplateMessageBuilder($this->altText, new ButtonTemplateBuilder(
            $this->title,
            $this->text,
            $this->thumbnail,
            $this->createActions($this->actions)
        ));
    }

    /**
     * @param $label
     * @param $text
     */
    public function addMessageAction($label, $text)
    {
        $this->actions[] = new Action($label, $text, Action::TYPE_MESSAGE);
    }

    /**
     * @param $label
     * @param $link
     */
    public function addUriAction($label, $link)
    {
        $this->actions[] = new Action($label, $link, Action::TYPE_URI);
    }

    /**
     * @param $label
     * @param $data
     */
    public function addPostbackAction($label, $data)
    {
        $this->actions[] = new Action($label, $data, Action::TYPE_POSTBACK);
    }
}
