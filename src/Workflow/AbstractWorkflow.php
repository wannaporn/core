<?php

namespace LineMob\Core\Workflow;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Validator\DefinitionValidatorInterface;
use Symfony\Component\Workflow\Validator\StateMachineValidator;
use Symfony\Component\Workflow\Validator\WorkflowValidator;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;

abstract class AbstractWorkflow
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param EventDispatcherInterface|null $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher = null)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param array $config
     *
     * @return DefinitionValidatorInterface
     */
    protected function getDefinitionValidator(array $config)
    {
        if ('state_machine' === $config['type']) {
            return new StateMachineValidator();
        }

        if ('single_state' === $config['marking_store']) {
            return new WorkflowValidator(true);
        }

        return new WorkflowValidator();
    }

    /**
     * @return Workflow
     */
    public function create()
    {
        $config = array_replace_recursive([
            'name' => get_class($this),
            'places' => [],
            'transitions' => [],
            'type' => 'workflow',
            'marking_store' => [
                'type' => 'single_state',
                'arguments' => ['state']
            ]
        ], $this->getConfig());

        $definitionBuilder = new DefinitionBuilder();
        $definitionBuilder->addPlaces((array) $config['places']);

        $transitions = [];
        foreach ((array) $config['transitions'] as $name => $transition) {
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
        if ('multiple_state' === $config['marking_store']['type']) {
            $marking = new MultipleStateMarkingStore(...$markingStoreArguments);
        } else {
            $marking = new SingleStateMarkingStore(...$markingStoreArguments);
        }

        $this->getDefinitionValidator($config)->validate($definition, $config['name']);

        return new Workflow($definition, $marking, $this->dispatcher, $config['name']);
    }

    /**
     * @return array
     */
    abstract protected function getConfig();
}
