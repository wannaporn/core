<?php

namespace LineMob\Core\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use LineMob\Core\Input;
use LineMob\Core\RegistryInterface;
use LineMob\Core\Storage\CommandStorageInterface;

class RegistryDecorator implements RegistryInterface
{
    /**
     * @var RegistryInterface
     */
    private $decoratedRegistry;

    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(RegistryInterface $decoratedRegistry, ObjectRepository $repository)
    {
        $this->decoratedRegistry = $decoratedRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function add($commandClass, $default = false)
    {
        $this->decoratedRegistry->add($commandClass, $default);
    }

    /**
     * @param string $userId
     *
     * @return null|object|CommandStorageInterface
     */
    private function findUser($userId)
    {
        return $this->repository->findOneBy(['lineUserId' => $userId]);
    }

    /**
     * {@inheritdoc}
     */
    public function findCommand(Input $input)
    {
        $command = $this->decoratedRegistry->findCommand($input);

        if ($user = $this->findUser($input->userId)) {
            if ($activedCmd = $user->getLineActivedCmd()) {
                $originText = $input->text;
                $input->text = $activedCmd;

                // find previous command
                $command = $this->decoratedRegistry->findCommand($input);

                $input->text = $originText;
            }
        }

        return $command;
    }
}
