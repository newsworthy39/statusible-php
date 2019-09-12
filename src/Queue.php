<?php declare(strict_types=1);

namespace newsworthy39;

class Queue
{

    // TODO: Use a strategy, so a queue, can be constructed 
    // and placed in a container, like-so: container->add(queue()->setStrategy(app->redis));
    private $redis;
    public function __construct()
    {
        // get container
        $this->redis = app()->get(\Predis\Client::class);
    }

    public function publish($data)
    {
        if (is_object($data))
            $this->redis->publish('workqueue', serialize($data));
    }
}
