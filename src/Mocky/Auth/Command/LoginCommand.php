<?php

namespace LineMob\Core\Mocky\Auth\Command;

class LoginCommand extends BaseCommand
{
    const CMD = ':login';

    protected $cmd = self::CMD;
    public $active = true;
}
