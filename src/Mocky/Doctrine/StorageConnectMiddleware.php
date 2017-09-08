<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Mocky\Doctrine;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Mocky\Doctrine\Model\User;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class StorageConnectMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        $repository = Manager::getRepository(User::class);

        if (!$user = $repository->findOneBy(['lineUserId' => $command->input->userId])) {
            $user = new User();
        }

        $command->storage = $user;
        $command->merge((array) $user->getLineCommandData());

        $user->setLineUserId($command->input->userId);

        return $next($command);
    }
}
