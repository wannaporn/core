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

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Validator\DefinitionValidatorInterface;
use Symfony\Component\Workflow\Validator\StateMachineValidator;
use Symfony\Component\Workflow\Validator\WorkflowValidator;
use Symfony\Component\Workflow\Workflow;

/**
 * @author phakpoom <phakpoom@gmail.com>
 */
class WorkflowRegistry implements WorkflowRegistryInterface
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var boolean
     */
    protected $isDevMode;

    /**
     * @param EventDispatcherInterface|null $dispatcher
     * @param bool $isDevMode
     */
    public function __construct(EventDispatcherInterface $dispatcher = null, $isDevMode = false)
    {
        $this->registry = new Registry();
        $this->dispatcher = $dispatcher;
        $this->isDevMode = $isDevMode;
    }

    /**
     * @param array $config
     *
     * @return DefinitionValidatorInterface
     */
    private function getDefinitionValidator(array $config)
    {
        if ('state_machine' === $config['type']) {
            return new StateMachineValidator();
        }

        return new WorkflowValidator('single_state' === $config['marking_store']);
    }

    /**
     * {@inheritdoc}
     */
    public function register(array $config)
    {
        $config = array_replace_recursive(
            [
                'name' => get_class($this),
                'places' => [],
                'supports' => [],
                'transitions' => [],
                'type' => 'workflow',
                'marking_store' => [
                    'type' => 'single_state',
                    'arguments' => ['state'],
                ],
            ],
            $config
        );

        if ($this->isDevMode && empty($config['supports'])) {
            throw new \InvalidArgumentException("The `supports` can't be empty, Please provide entity classes.");
        }

        $transitions = [];
        $definitionBuilder = new DefinitionBuilder();
        $definitionBuilder->addPlaces((array)$config['places']);

        foreach ((array)$config['transitions'] as $name => $transition) {
            if ('workflow' === $config['type']) {
                $transitions[] = new Transition($name, $transition['from'], $transition['to']);
            } elseif ('state_machine' === $config['type']) {
                foreach ((array)$transition['from'] as $from) {
                    foreach ((array)$transition['to'] as $to) {
                        $transitions[] = new Transition($name, $from, $to);
                    }
                }
            }
        }

        $definitionBuilder->addTransitions($transitions);
        $definition = $definitionBuilder->build();
        $markingStoreArguments = $config['marking_store']['arguments'];

        $marking = new SingleStateMarkingStore(...$markingStoreArguments);

        if ('multiple_state' === $config['marking_store']['type']) {
            $marking = new MultipleStateMarkingStore(...$markingStoreArguments);
        }

        if ($this->isDevMode) {
            $this->getDefinitionValidator($config)->validate($definition, $config['name']);
        }

        $workflow = new Workflow($definition, $marking, $this->dispatcher, $config['name']);

        foreach ($config['supports'] as $class) {
            $this->registry->add($workflow, $class);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($subject, $workflowName = null)
    {
        return $this->registry->get($subject, $workflowName);
    }
}
