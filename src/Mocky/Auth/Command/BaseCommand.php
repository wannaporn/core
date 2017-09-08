<?php

namespace LineMob\Core\Mocky\Auth\Command;

use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Mocky\Doctrine\Model\User;
use LineMob\Core\Template\TextTemplate;

class BaseCommand extends AbstractCommand
{
    /**
     * @var User
     */
    public $storage;

    /**
     * @var TextTemplate
     */
    public $message;

    /**
     * @var bool
     */
    public $secured = false;
}
