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

use Symfony\Component\Workflow\Workflow;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
interface WorkflowRegistryInterface
{
    /**
     * @param array $config
     */
    public function register(array $config);

    /**
     * @param $subject
     * @param null $workflowName
     *
     * @return Workflow
     */
    public function get($subject, $workflowName = null);
}
