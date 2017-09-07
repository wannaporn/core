<?php

namespace LineMob\Core\Mocky\Auth\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Mocky\Auth\Command\LoginCommand;
use LineMob\Core\Mocky\Doctrine\Model\User;

class AuthorizationMiddleware implements Middleware
{
    /**
     * @var string
     */
    private $expirationPeriod;

    public function __construct($expirationPeriod = '1 day')
    {
        $this->expirationPeriod = $expirationPeriod;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if (!$command->storage) {
            throw new \LogicException("Require storage before using this middleware!");
        }

        if (!$command->secured) {
            return $next($command);
        }

        if (!$this->isSecureExpired($command->storage)) {
            return $next($command);
        }

        $cmd = new LoginCommand();
        $cmd->input = $command->input;
        $cmd->storage = $command->storage;
        $cmd->logs = $command->logs;

        $command['switchTo'] = $cmd;

        return $next($command);

    }

    /**
     * @param User $user
     *
     * @return bool
     */
    private function isSecureExpired(User $user)
    {
        // never expired
        if (!$this->expirationPeriod) {
            return false;
        }

        if (!$lastLogin = $user->getLineLastLogin()) {
            return true;
        }

        return (new \DateTime('-'.$this->expirationPeriod)) > $lastLogin;
    }
}
