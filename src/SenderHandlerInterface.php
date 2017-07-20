<?php

namespace LineMob\Core;

use LineMob\Core\Command\AbstractCommand;

interface SenderHandlerInterface
{
    /**
     * @param AbstractCommand $command
     *
     * @return mixed
     */
    public function handle(AbstractCommand $command);
}
