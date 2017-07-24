<?php

namespace LineMob\Core;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Plugins\LockingMiddleware;
use LINE\LINEBot;
use LineMob\Core\HttpClient\GuzzleHttpClient;
use LineMob\Core\Message\CarouselMessage;
use LineMob\Core\Message\Factory;
use LineMob\Core\Message\TextMessage;

class QuickStart
{
    /**
     * @var array
     */
    private $commands = [];

    /**
     * @var array
     */
    private $middlewares = [];

    /**
     * QuickStart constructor.
     *
     * @param array $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @param string $command FQCN
     * @param bool $default
     *
     * @return $this
     */
    public function addCommand($command, $default = false)
    {
        $this->commands[$command] = $default;

        return $this;
    }

    public function setup($lineChannelToken, $lineChannelSecret, array $httpClientConfig = [])
    {
        $linebot = new LINEBot(new GuzzleHttpClient($lineChannelToken, $httpClientConfig), ['channelSecret' => $lineChannelSecret]);

        $factory = new Factory();
        $factory->add(new TextMessage());
        $factory->add(new CarouselMessage());

        $handler = new SenderHandler($linebot, $factory);

        $registry = new Registry();

        foreach ($this->commands as $command => $default) {
            $registry->add($command, $handler, $default);
        }

        // should be first of all middlewares
        array_unshift($this->middlewares, new LockingMiddleware());

        // must be end of all middlewares
        array_push( $this->middlewares,
            new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new InMemoryLocator($registry->getCommandList()),
                new HandleInflector()
            )
        );

        $commandBus = new CommandBus($this->middlewares);

        return new Receiver($linebot, $registry, $commandBus);
    }
}
