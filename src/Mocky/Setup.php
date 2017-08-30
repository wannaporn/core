<?php

namespace LineMob\Core\Mocky;

use LineMob\Core\Middleware\CommandSwitcherMiddleware;
use LineMob\Core\Middleware\DummyFallbackMiddleware;
use LineMob\Core\Middleware\DumpLogMiddleware;
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
}
