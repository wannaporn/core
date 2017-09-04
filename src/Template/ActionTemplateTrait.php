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

use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 *
 * @property array actions
 * @property string altText
 * @property string title
 */
trait ActionTemplateTrait
{
    /**
     * @return Action[]
     */
    private function createActions()
    {
        $actions = [];

        foreach ($this->actions as $action) {
            switch (strtolower($action->type)) {
                case Action::TYPE_POSTBACK:
                    $actions[] = new PostbackTemplateActionBuilder($action->label, $action->value);
                    break;
                case Action::TYPE_URI:
                    $actions[] = new UriTemplateActionBuilder($action->label, $action->value);
                    break;
                default:
                    $actions[] = new MessageTemplateActionBuilder($action->label, $action->value);
            }
        }

        return $actions;
    }
}
