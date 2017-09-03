<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use LineMob\Core\Mocky\Doctrine\Manager;

return ConsoleRunner::createHelperSet(Manager::get(true));
