<?php

namespace LineMob\Core;

/**
 * @property string $text
 * @property string $userId
 * @property string $replyToken
 */
class Input
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        $data['text'] = trim(preg_replace(['/ +/'], [' '], $data['text']));

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string)$this->data['text'];
    }

    /**
     * {@inheritdoc}
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function __set($name, $value)
    {
        throw new \LogicException('Impossible to set on a frozen input.');
    }
}
