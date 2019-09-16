<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

// tactician stuff.
use League\Container\Container;
use League\Tactician\CommandBus;
use League\Container\ReflectionContainer;
use League\Tactician\Container\ContainerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameInflector;

// our own.
use newsworthy39\User\Handler\SignupUserHandler;
use newsworthy39\User\Event\UserSignupEvent;

use newsworthy39\User\Event\UserSigninEvent;
use newsworthy39\User\Handler\SigninUserHandler;

// Map your command classes to the container id of your handler. When using
// League\Container, the container id is typically the class or interface name
$mapping = [
    
    UserSignupEvent::class => SignupUserHandler::class,
    UserSigninEvent::class => SigninUserHandler::class,
];

// Next we create a new Tactician ContainerLocator, passing in both
// a fully configured container instance and the map.
$containerLocator = new ContainerLocator(
    (app())->delegate(new ReflectionContainer()),
    $mapping
);

$handlerMiddleware = new CommandHandlerMiddleware(
    new ClassNameExtractor(),
    $containerLocator,
    new HandleClassNameInflector()
);
$commandBus = new CommandBus([$handlerMiddleware]);

$pubsub = app()->get(Predis\Client::class)->pubSubLoop();

// Subscribe to your channels
$pubsub->subscribe('control_channel', 'workqueue');

// Start processing the pubsup messages. Open a terminal and use redis-cli
// to push messages to the channels. Examples:
//   ./redis-cli PUBLISH notifications "this is a test"
//   ./redis-cli PUBLISH control_channel quit_loop
foreach ($pubsub as $message) {
    switch ($message->kind) {
        case 'subscribe':
            echo "Subscribed to {$message->channel}", PHP_EOL;
            break;
        case 'message':
            if ($message->channel == 'control_channel') {
                if ($message->payload == 'quit_loop') {
                    echo 'Aborting pubsub loop...', PHP_EOL;
                    $pubsub->unsubscribe();
                } else {
                    echo "Received an unrecognized command: {$message->payload}.", PHP_EOL;
                }
            } else {
                
                echo "Received the following message from {$message->channel}:",
                                PHP_EOL, "  {$message->payload}", PHP_EOL, PHP_EOL;

                $command = unserialize($message->payload);

                // handle code, via Tactician.
                $commandBus->handle($command);

                // log via framework?
                // or via event?
            }
        }
    }

