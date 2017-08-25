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

use LineMob\Core\Template\TemplateInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
abstract class AbstractMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTemplate(TemplateInterface $template)
    {
        return $template->getTemplate();
    }
}
