<?php

namespace LineMob\Core\Mocky\Auth\Command;

use LineMob\Core\Command\AbstractCommand;

class SecuredCommand extends AbstractCommand
{
    public $secured = true;
    public $cmd = 'secure';
}
