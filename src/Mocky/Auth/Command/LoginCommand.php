<?php

namespace LineMob\Core\Mocky\Auth\Command;

use LineMob\Core\Command\AbstractCommand;

class LoginCommand extends AbstractCommand
{
    protected $cmd = ':login';

    public $active = true;
}
