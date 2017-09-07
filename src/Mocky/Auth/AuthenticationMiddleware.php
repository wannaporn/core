<?php

namespace LineMob\Core\Mocky\Auth;

use League\Tactician\Middleware;
use LineMob\Core\Input;
use LineMob\Core\Mocky\Doctrine\Model\User;
use LineMob\Core\Template\TextTemplate;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;

class AuthenticationMiddleware implements Middleware
{
    /**
     * @var Registry
     */
    private $registry;

    public function __construct()
    {
        $definitionBuilder = new DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(
            ['started', 'wait_for_username', 'wait_for_password', 'wait_for_username_n_password', 'finished']
        )
            ->addTransition(new Transition('start', 'started', ['wait_for_username_n_password', 'wait_for_username']))
            ->addTransition(new Transition('enter_username', 'wait_for_username', 'wait_for_password'))
            ->addTransition(new Transition('enter_username_n_password', 'wait_for_username_n_password', 'finished'))
            ->addTransition(new Transition('enter_password', 'wait_for_password', 'finished'))
            ->build();

        $workflow = new Workflow($definition, new MultipleStateMarkingStore('state'));
        $this->registry = new Registry();
        $this->registry->add($workflow, User::class);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if (!$subject = $command->storage) {
            throw new \LogicException("Require storage before using this AuthenticationMiddleware!");
        }

        if (!$command instanceof LoginCommand) {
            return $next($command);
        }

        $command->active = true;
        $command->message = new TextTemplate();

        $workflow = $this->registry->get($subject);

        if ($workflow->can($subject, 'start')) {
            $workflow->apply($subject, 'start');

            $command->message->text = 'Please Enter username & password.';

            return $next($command);
        }

        @list($username, $password) = $this->captureUserAndPassword($command->input);

        if ($username && $password && $workflow->can($subject, 'enter_username_n_password')) {
            if ($username === 'demo' && $password === 'demo') {
                $workflow->apply($subject, 'enter_username_n_password');

                $command->storage->setLineLastLogin(new \DateTimeImmutable());
                $command->active = false;
                $command->message->text = 'Success!';
            } else {
                $command->message->text = 'Try again ...';
            }

            return $next($command);
        }

        if ($username && $workflow->can($subject, 'enter_username')) {
            if ($username === 'demo') {
                $workflow->apply($subject, 'enter_username');

                $command->message->text = 'Please Enter password!';
            } else {
                $command->message->text = 'Not found username, Try again ...';
            }

            return $next($command);
        }

        $password = $username;

        if ($password && $workflow->can($subject, 'enter_password')) {
            if ($password === 'demo') {
                $workflow->apply($subject, 'enter_password');

                $command->storage->setLineLastLogin(new \DateTimeImmutable());
                $command->active = false;
                $command->message->text = 'Success!';
            } else {
                $command->message->text = 'Password not match, Try again ...';
            }

            return $next($command);
        }

        throw new \LogicException("Unknown case!");
    }

    private function captureUserAndPassword(Input $input)
    {
        $text = trim(preg_replace('|\W+|', ' ', $input->text));

        return explode(' ', $text);
    }
}
