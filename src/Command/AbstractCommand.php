<?php

namespace LineMob\Core\Command;

use LineMob\Core\Constants;
use LineMob\Core\Input;
use LineMob\Core\Storage\CommandStorageInterface;

/**
 * Class AbstractCommand
 *
 * @package LineMob\Handler
 *
 * @property boolean $actived
 * @property Input $input
 * @property string $message
 * @property string $cmd
 * @property string $emoticon
 * @property string $type
 * @property string $mode
 * @property array $tos
 * @property string $to
 * @property string $logs
 */
abstract class AbstractCommand implements \ArrayAccess, \JsonSerializable
{
    /**
     * @var CommandStorageInterface
     */
    public $storage;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;

        if (!$this->type) {
            $this->type = Constants::TYPE_TEXT;
        }
    }

    /**
     * @param array $data
     */
    public function merge(array $data)
    {
        $this->data = array_replace_recursive($this->data, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * {@inheritdoc}
     */
    public function __set($name, $value)
    {
        if ('logs' === $name) {
            if (empty($this->data['logs'])) {
                $this->data['logs'] = [];
            }

            array_push($this->data['logs'], $value);
            return;
        }

        $this->offsetSet($name, $value);
    }

    /**
     * @param string $cmd
     * @return bool
     */
    public function supported($cmd)
    {
        return $this->cmd === $cmd;
    }
}
