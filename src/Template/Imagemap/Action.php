<?php

namespace LineMob\Core\Template\Imagemap;

class Action
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string|null
     */
    public $text;

    /**
     * @var string|null
     */
    public $link;

    /**
     * @var ActionArea
     */
    public $area;

    public function __construct(array $text)
    {

    }
}
