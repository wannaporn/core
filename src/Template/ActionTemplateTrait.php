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

use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 *
 * @property array actions
 */
trait ActionTemplateTrait
{
    /**
     * @param Action[]
     *
     * @return TemplateActionBuilder[]
     */
    private function createActions($actions)
    {
        $actionBuilders = [];

        foreach ($actions as $action) {
            switch (strtolower($action->type)) {
                case Action::TYPE_POSTBACK:
                    $actionBuilders[] = new PostbackTemplateActionBuilder($action->label, $action->value);
                    break;
                case Action::TYPE_URI:
                    $actionBuilders[] = new UriTemplateActionBuilder($action->label, $action->value);
                    break;
                default:
                    $actionBuilders[] = new MessageTemplateActionBuilder($action->label, $action->value);
            }
        }

        return $actionBuilders;
    }
}
