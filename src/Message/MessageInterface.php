<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Message;

use LINE\LINEBot\MessageBuilder;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\TemplateInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface MessageInterface
{
    /**
     * @param TemplateInterface $template
     *
     * @return MessageBuilder
     */
    public function createTemplate(TemplateInterface $template);

    /**
     * @param AbstractCommand $command
     *
     * @return boolean
     */
    public function supported(AbstractCommand $command);
}
