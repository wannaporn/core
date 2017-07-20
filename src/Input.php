<?php

namespace LineMob\Core;

class Input implements \Serializable
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $replyToken;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        foreach (unserialize($serialized) as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
