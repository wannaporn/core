<?php

namespace LineMob\Core\Mocky\Auth;

use LineMob\Core\Command\AbstractCommand;

class SecuredCommand extends AbstractCommand
{
    public $secured = true;
}
