<?php declare(strict_types = 1);

namespace newsworthy39;

class Queue {
    
    // TODO: Use a strategy, so a queue, can be constructed 
    // and placed in a container, like-so: container->add(queue()->setStrategy(app->redis));
    private $redis;
    public function __construct() {

           // get container
           $app = new Config();
           // Parameters passed using a named array:
           $conn = $app->redis();
           $this->redis = new \Predis\Client($conn + array('read_write_timeout' => 0));
        
    }

    public function publish($data) {
        if (is_object($data))
            $this->redis->publish('workqueue', serialize($data));
    }
}
