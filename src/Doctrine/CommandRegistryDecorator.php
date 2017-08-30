<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core\Doctrine;

use Doctrine\Common\Persistence\ObjectRepository;
use LineMob\Core\Command\AbstractCommand;
use LineMob\Core\Command\FallbackCommand;
use LineMob\Core\Input;
use LineMob\Core\RegistryInterface;
use LineMob\Core\CommandHandlerInterface;
use LineMob\Core\Storage\CommandDataInterface;
use LineMob\Core\Storage\CommandInterface;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class CommandRegistryDecorator implements RegistryInterface
{
    /**
     * @var RegistryInterface
     */
    private $decoratedRegistry;

    /**
     * @var ObjectRepository
     */
    private $commandRepository;

    /**
     * @var ObjectRepository
     */
    private $commandDataRepository;

    public function __construct(
        RegistryInterface $decoratedRegistry,
        ObjectRepository $commandRepository,
        ObjectRepository $commandDataRepository
    ) {
        $this->decoratedRegistry = $decoratedRegistry;
        $this->commandRepository = $commandRepository;
        $this->commandDataRepository = $commandDataRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function add($commandClass, CommandHandlerInterface $handler, $default = false)
    {
        $this->decoratedRegistry->add($commandClass, $handler, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandList()
    {
        return $this->decoratedRegistry->getCommandList();
    }

    /**
     * @return CommandInterface[]
     */
    private function findAllModels()
    {
        return $this->commandRepository->findBy(['enabled' => true]);
    }

    /**
     * @param string $userId
     *
     * @return null|object|CommandDataInterface
     */
    private function findUser($userId)
    {
        return $this->commandDataRepository->findOneBy(['lineUserId' => $userId]);
    }

    /**
     * @param Input $input
     *
     * @return CommandInterface|null
     */
    private function filterModel(Input $input)
    {
        $models = array_filter(
            $this->findAllModels(),
            function (CommandInterface $command) use ($input) {
                return preg_match(preg_quote($command->getCmd()), $input->text);
            }
        );

        if (empty($models)) {
            return null;
        }

        return $models[0];
    }

    private function findCommandWithModel(Input $input)
    {
        $model = $this->filterModel($input);
        $default = new FallbackCommand();

        foreach (array_keys($this->getCommandList()) as $command) {
            /** @var AbstractCommand $cmd */
            $cmd = new $command([
                'cmd' => $model->getCmd(),
                'name' => $model->getName(),
                'description' => $model->getDescription(),
            ]);

            if ($cmd->getCode() === $model->getCode()) {
                $default = $cmd;
                break;
            }
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function findCommand(Input $input)
    {
        $command = $this->findCommandWithModel($input);

        if ($user = $this->findUser($input->userId)) {
            if ($activeCmd = $user->getLineActiveCmd()) {

                // no side effect input
                $copiedInput = new Input(['text' => $activeCmd]);

                // find previous command
                $command = $this->findCommand($copiedInput);
            }
        }

        return $command;
    }
}
