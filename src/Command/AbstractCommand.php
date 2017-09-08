<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Command;

use LineMob\Core\Input;
use LineMob\Core\Storage\CommandDataInterface;
use LineMob\Core\Template\TemplateInterface;

/**
 * @property boolean $active
 * @property string $logs
 * @property AbstractCommand|null $switchTo
 *
 * @author Ishmael Doss <nukboon@gmail.com>
 */
abstract class AbstractCommand implements \ArrayAccess
{
    /**
     * @var string a persistent code
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $cmd;

    /**
     * @var CommandDataInterface
     */
    public $storage;

    /**
     * @var Input
     */
    public $input;

    /**
     * @var TemplateInterface
     */
    public $message;

    /**
     * @var string
     */
    public $mode;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string[]
     */
    public $tos;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $logData = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setForzenParameters($data);

        $this->data = array_replace_recursive($this->data, $data);
    }

    /**
     * @param array $data
     */
    private function setForzenParameters(array &$data)
    {
        foreach (['name', 'description', 'cmd'] as $value) {
            if (array_key_exists($value, $data)) {
                $this->$value = $data[$value];
                unset($data[$value]);
            }
        }
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCmd()
    {
        return $this->cmd;
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
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function __get($name)
    {
        if ('logs' === $name) {
            return $this->logData;
        }

        return $this->offsetGet($name);
    }

    /**
     * {@inheritdoc}
     */
    public function __set($name, $value)
    {
        if ('logs' === $name) {
            if (empty($this->logData)) {
                $this->logData = [];
            }

            array_push($this->logData, $value);

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

    /**
     * @param string $commandClass
     * @param array $args
     *
     * @return AbstractCommand
     */
    public function switchTo($commandClass, array $args = [])
    {
        $cmd = new $commandClass($args);
        $cmd->input = $this->input;
        $cmd->storage = $this->storage;
        $cmd->logs = $this->logs;
        $this->switchTo = $cmd;

        return $cmd;
    }
}
