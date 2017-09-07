<?php

namespace LineMob\Core\Mocky;

use LineMob\Core\Middleware\ClearActiveCmdMiddleware;
use LineMob\Core\Middleware\CommandSwitcherMiddleware;
use LineMob\Core\Middleware\DummyFallbackMiddleware;
use LineMob\Core\Middleware\DumpLogMiddleware;
use LineMob\Core\Middleware\StoreActiveCmdMiddleware;
use LineMob\Core\Mocky\Auth\AuthenticationWorkflow;
use LineMob\Core\Mocky\Auth\Command\ClearActiveCommand;
use LineMob\Core\Mocky\Auth\Command\LoginCommand;
use LineMob\Core\Mocky\Auth\Command\LogoutCommand;
use LineMob\Core\Mocky\Auth\Command\NonSecuredCommand;
use LineMob\Core\Mocky\Auth\Command\SecuredCommand;
use LineMob\Core\Mocky\Auth\Middleware\AuthenticationMiddleware;
use LineMob\Core\Mocky\Auth\Middleware\AuthorizationMiddleware;
use LineMob\Core\Mocky\Auth\Middleware\ClearActiveMiddleware;
use LineMob\Core\Mocky\Auth\Middleware\LogoutMiddleware;
use LineMob\Core\Mocky\Doctrine\Model\User;
use LineMob\Core\Mocky\Doctrine\StorageConnectMiddleware;
use LineMob\Core\Mocky\Doctrine\StoragePersistMiddleware;
use LineMob\Core\Mocky\Switcher\SomeCommand;
use LineMob\Core\Mocky\Switcher\SwitchedCommand;
use LineMob\Core\Mocky\Switcher\SwitchingMiddleware;
use LineMob\Core\QuickStart;
use Symfony\Component\Workflow\Registry as WorkflowRegistry;

class Setup
{
    /**
     * @param array $data
     *
     * @return array
     */
    public static function switching(array $data)
    {
        return (new QuickStart(
            [
                new SwitchingMiddleware(),
                new CommandSwitcherMiddleware(),
                new DummyFallbackMiddleware(),
                new DumpLogMiddleware(true),
            ]
        ))
            ->addCommand(SomeCommand::class, true)
            ->addCommand(SwitchedCommand::class)
            ->setup(null, null, [], new Sender())
            ->handle(json_encode($data));
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function authen(array $data)
    {
        $workflowRegistry = new WorkflowRegistry();
        $workflowRegistry->add((new AuthenticationWorkflow())->create(), User::class);

        return (new QuickStart(
            [
                new StorageConnectMiddleware(),
                new ClearActiveMiddleware(), // Clear user's storage active
                new LogoutMiddleware(),
                new AuthorizationMiddleware(),
                new CommandSwitcherMiddleware(),
                new AuthenticationMiddleware($workflowRegistry),
                new DummyFallbackMiddleware(),
                new StoreActiveCmdMiddleware(),
                new StoragePersistMiddleware(),
                new DumpLogMiddleware(true),
            ]
        ))
            ->addCommand(NonSecuredCommand::class, true)
            ->addCommand(ClearActiveCommand::class)
            ->addCommand(SecuredCommand::class)
            ->addCommand(LoginCommand::class)
            ->addCommand(LogoutCommand::class)
            ->setup(null, null, [], new Sender())
            ->handle(json_encode($data));
    }
}
