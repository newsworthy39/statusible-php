<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use \newsworthy39\Backend;

if(false != strstr($_SERVER['HTTP_USER_AGENT'],"GitHub-Hookshot")) {

        // get container
        $app = new Config();

        // Parameters passed using a named array:
        $conn = $app->redis();

        $client = new Predis\Client($conn);

        $backend = new Backend();

        // when dealing with queues and hook-shots, we fetch our secret based on the queue-id:
        list($omit, $omit2, $queue_id, $remainder) = explode('/',$_SERVER['REQUEST_URI']);
        $secret = $backend->secrets($queue_id);

        if ($secret != false) {
                $post_data = file_get_contents('php://input');
                $signature = sprintf("sha1=%s", hash_hmac('sha1', $post_data, $secret));

                // We have verified, that it is in fact a valid request.
                if ( $_SERVER['HTTP_X_HUB_SIGNATURE'] == $signature ) {
                    $post_data= urldecode($post_data);
                    list($key, $payload) = explode('=', $post_data, 2);
                    $client->publish('workqueue-github', $payload);
                    echo "Signature-verified Github Hook-shot.";
                }
        }
}

?>

