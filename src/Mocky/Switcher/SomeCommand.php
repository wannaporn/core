<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Mocky\Switcher;

use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\TextTemplate;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class SomeCommand extends AbstractCommand
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->message = new TextTemplate();
        $this->message->text = 'SomeCommand';
    }
}
