<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Message;

use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Template\StickerTemplate;

/**
* @author Taned Suparpornhemin <taned@intbizth.com>
*/
class StickerMessage extends AbstractMessage
{
    /**
     * {@inheritdoc}
     */
    public function supported(AbstractCommand $command)
    {
        return $command->message instanceof StickerTemplate;
    }
}
