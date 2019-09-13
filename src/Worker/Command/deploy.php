<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use boxeye\Config;

// get container
$app = new Config();

// Parameters passed using a named array:
$conn = $app->redis();
$redis = new Predis\Client($conn + array('read_write_timeout' => 0));
$pubsub = $redis->pubSubLoop();

// Subscribe to your channels
$pubsub->subscribe('control_channel', 'workqueue-github-completed');

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

                $payload = json_decode($message->payload);

                // let composer, take care of this pipelines deployment.
                system("cd __DIR__ && /usr/bin/docker-compose -f docker-composer.yml up -d");

                // Notify listeners (if any)
                // Parameters passed using a named array:
                //
                $redis = new Predis\Client($conn);
                $redis->publish('workqueue-github-deployed', json_encode(array('deployed' => 'docker-composer.yml')));
                $redis->unsubscribe();

            }
            break;
    }
}


?>

