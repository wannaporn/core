<?php

namespace LineMob\Core\Mocky\Auth\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Input;
use LineMob\Core\Mocky\Auth\Command\ClearActiveCommand;
use LineMob\Core\Mocky\Doctrine\Model\User;
use LineMob\Core\Template\TextTemplate;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;

class ClearActiveMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if (!$command instanceof ClearActiveCommand) {
            return $next($command);
        }

        if (!$subject = $command->storage) {
            throw new \LogicException("Require storage before using this middleware!");
        }

        $command->message = new TextTemplate();
        $command->message->text = sprintf('Cancel a command %s', $command->storage->getLineActiveCmd());

        /** @var User $subject */
        $subject->setLineActiveCmd(null);
        $subject->setLineCommandData([]);
        $subject->setState([User::START_STATE => 1]);

        return $next($command);
    }
}
