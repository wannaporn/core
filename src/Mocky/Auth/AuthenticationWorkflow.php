<?php

namespace LineMob\Core\Mocky\Auth;

use LineMob\Core\Workflow\AbstractWorkflow;

class AuthenticationWorkflow extends AbstractWorkflow
{
    /**
     * {@inheritdoc}
     */
    protected function getConfig()
    {
        return [
            'name' => 'Authentication',
            'marking_store' => [
                'type' => 'multiple_state',
                'arguments' => ['state']
            ],
            'places' => [
                'started',
                'wait_for_username',
                'wait_for_password',
                'wait_for_username_n_password',
                'finished'
            ],
            'transitions' => [
                'start' => [
                    'from' => 'started',
                    'to' => ['wait_for_username_n_password', 'wait_for_username']
                ],
                'enter_username' => [
                    'from' => 'wait_for_username',
                    'to' => 'wait_for_password'
                ],
                'enter_password' => [
                    'from' => 'wait_for_password',
                    'to' => 'finished'
                ],
                'enter_username_n_password' => [
                    'from' => 'wait_for_username_n_password',
                    'to' => 'finished'
                ],
            ]
        ];
    }
}
