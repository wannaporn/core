<?php

namespace LineMob\Core\Template\Imagemap;

class Action
{
    const TYPE_MESSAGE = 'message';
    const TYPE_URI = 'uri';

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

    public function __construct(ActionArea $area, $type, $text = null, $link = null)
    {
        $this->type = $type;
        $this->text = $text;
        $this->link = $link;
        $this->area = $area;
    }
}
