<?php

namespace LineMob\Core\Message;

use LineMob\Core\Template\TemplateInterface;

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
