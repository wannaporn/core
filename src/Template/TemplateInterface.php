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

use LINE\LINEBot\MessageBuilder;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface TemplateInterface extends \JsonSerializable
{
    /**
     * @return MessageBuilder
     */
    public function getTemplate();
}
