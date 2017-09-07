<?php

namespace LineMob\Core\Mocky;

use LineMob\Core\Middleware\ClearActiveCmdMiddleware;
use LineMob\Core\Middleware\CommandSwitcherMiddleware;
use LineMob\Core\Middleware\DummyFallbackMiddleware;
use LineMob\Core\Middleware\DumpLogMiddleware;
use LineMob\Core\Middleware\StoreActiveCmdMiddleware;
use LineMob\Core\Mocky\Auth\AuthenticationMiddleware;
use LineMob\Core\Mocky\Auth\AuthorizationMiddleware;
use LineMob\Core\Mocky\Auth\LoginCommand;
use LineMob\Core\Mocky\Auth\SecuredCommand;
use LineMob\Core\Mocky\Doctrine\StorageConnectMiddleware;
use LineMob\Core\Mocky\Doctrine\StoragePersistMiddleware;
use LineMob\Core\Mocky\Switcher\SomeCommand;
use LineMob\Core\Mocky\Switcher\SwitchedCommand;
use LineMob\Core\Mocky\Switcher\SwitchingMiddleware;
use LineMob\Core\QuickStart;

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
        return (new QuickStart(
            [
                new ClearActiveCmdMiddleware(),
                new StorageConnectMiddleware(),
                new AuthorizationMiddleware(),
                new CommandSwitcherMiddleware(),
                new AuthenticationMiddleware(),
                new DummyFallbackMiddleware(),
                new StoreActiveCmdMiddleware(),
                new StoragePersistMiddleware(),
                new DumpLogMiddleware(true),
            ]
        ))
            ->addCommand(SecuredCommand::class, true)
            ->addCommand(LoginCommand::class)
            ->setup(null, null, [], new Sender())
            ->handle(json_encode($data));
    }
}
