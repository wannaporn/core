<?php

namespace LineMob\Core\LineCorp\LINEBot\MessageBuilder\TemplateBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder;

/**
 * remove this class, when 'linecorp/line-bot-sdk' updated.
 */
class ImageCarouselTemplateBuilder implements TemplateBuilder
{
    /** @var ImageCarouselColumnTemplateBuilder[] */
    private $columnTemplateBuilders;

    /** @var array */
    private $template;

    /**
     * ImageCarouselTemplateBuilder constructor.
     *
     * @param ImageCarouselColumnTemplateBuilder[] $columnTemplateBuilders
     */
    public function __construct(array $columnTemplateBuilders)
    {
        $this->columnTemplateBuilders = $columnTemplateBuilders;
    }

    /**
     * Builds carousel template structure.
     *
     * @return array
     */
    public function buildTemplate()
    {
        if (!empty($this->template)) {
            return $this->template;
        }

        $columns = [];
        foreach ($this->columnTemplateBuilders as $columnTemplateBuilder) {
            $columns[] = $columnTemplateBuilder->buildTemplate();
        }

        $this->template = [
            'type' => 'image_carousel',
            'columns' => $columns,
        ];

        return $this->template;
    }
}
