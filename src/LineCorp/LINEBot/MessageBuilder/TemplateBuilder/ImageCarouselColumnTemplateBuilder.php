<?php

namespace LineMob\Core\LineCorp\LINEBot\MessageBuilder\TemplateBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder;

/**
 * remove this when 'linecorp/line-bot-sdk' updated
 */
class ImageCarouselColumnTemplateBuilder implements TemplateBuilder
{
    /** @var string */
    private $imageUrl;

    /** @var TemplateActionBuilder */
    private $actionBuilder;

    /** @var array */
    private $template;

    /**
     * ImageCarouselColumnTemplateBuilder constructor.
     *
     * @param string $imageUrl
     * @param TemplateActionBuilder $actionBuilder
     */
    public function __construct($imageUrl, $actionBuilder)
    {
        $this->imageUrl = $imageUrl;
        $this->actionBuilder = $actionBuilder;
    }

    /**
     * Builds column of carousel template structure.
     *
     * @return array
     */
    public function buildTemplate()
    {
        if (!empty($this->template)) {
            return $this->template;
        }

        $this->template = [
            'imageUrl' => $this->imageUrl,
            'action' => $this->actionBuilder->buildTemplateAction(),
        ];

        return $this->template;
    }
}
