<?php

namespace LineMob\Core\Template;

abstract class AbstractTemplate implements TemplateInterface
{
    final public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return $this;
    }
}
