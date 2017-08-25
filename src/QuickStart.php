<?php

/*
 * This file is part of the LineMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineMob\Core;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Plugins\LockingMiddleware;
use LineMob\Core\Factory\MessageFactory;
use LineMob\Core\HttpClient\GuzzleHttpClient;
use LineMob\Core\Message\AudioMessage;
use LineMob\Core\Message\CarouselMessage;
use LineMob\Core\Message\ImagemapMessage;
use LineMob\Core\Message\ImageMessage;
use LineMob\Core\Message\StickerMessage;
use LineMob\Core\Message\TextMessage;
use LineMob\Core\Message\VideoMessage;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
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

    /**
     * @param string $lineChannelToken
     * @param string $lineChannelSecret
     * @param array $httpClientConfig
     *
     * @return Receiver
     */
    public function setup($lineChannelToken, $lineChannelSecret, array $httpClientConfig = [])
    {
        $linebot = new LineBot(new GuzzleHttpClient($lineChannelToken, $httpClientConfig), ['channelSecret' => $lineChannelSecret]);
        $factory = new MessageFactory();
        $registry = new Registry();
        $handler = new SenderHandler($linebot, $factory);

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

        $factory->add(new CarouselMessage());
        $factory->add(new ImageMessage());
        $factory->add(new ImagemapMessage());
        $factory->add(new TextMessage());
        $factory->add(new StickerMessage());
        $factory->add(new AudioMessage());
        $factory->add(new VideoMessage());

        return new Receiver($linebot, $registry, new CommandBus($this->middlewares));
    }
}
