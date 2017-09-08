<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Workflow;

/**
 * @author phakpoom <phakpoom@gmail.com>
 */
abstract class AbstractWorkflow
{
    /**
     * @var WorkflowRegistryInterface
     */
    protected $registry;

    /**
     * @param WorkflowRegistryInterface $registry
     */
    public function __construct(WorkflowRegistryInterface $registry)
    {
        $registry->register($this->getConfig());
        $this->registry = $registry;
    }

    /**
     * @return array
     */
    abstract protected function getConfig();
}
