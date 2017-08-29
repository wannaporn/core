<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core;

/**
 * @property string $text
 * @property string $userId
 * @property string $replyToken
 *
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Input
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data = [])
    {
        if (array_key_exists('text', $data)) {
            $data['text'] = trim(preg_replace(['/ +/'], [' '], $data['text']));
        }

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
