<?php

namespace LineMob\Core\Template;

use LINE\LINEBot\MessageBuilder;

interface TemplateInterface extends \JsonSerializable
{
    /**
     * @return MessageBuilder
     */
    public function getTemplate();
}
