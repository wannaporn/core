<?php

namespace LineMob\Core\Mocky\Auth\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Input;
use LineMob\Core\Mocky\Auth\Command\LogoutCommand;
use LineMob\Core\Mocky\Doctrine\Model\User;
use LineMob\Core\Template\TextTemplate;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;

class LogoutMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if (!$subject = $command->storage) {
            throw new \LogicException("Require storage before using this AuthenticationMiddleware!");
        }

        if (!$command instanceof LogoutCommand) {
            return $next($command);
        }

        /** @var User $subject */
        $subject->setLineLastLogin(null);
        $subject->setState([User::START_STATE => 1]);

        $command->message = new TextTemplate();
        $command->message->text = 'ออกจากระบบสำเร็จ !';

        return $next($command);
    }
}
