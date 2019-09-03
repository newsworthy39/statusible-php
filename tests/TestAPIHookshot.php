<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \newsworthy39\Backend;

final class TestAPIHookshot extends TestCase
{
    public function testCanAcceptGithubHookshots(): void
    {
        // Now that the queue is present, lets setup the test
        $backend = new Backend();

        // when dealing with queues and hook-shots, we fetch our secret based on the queue-id:
        list($omit, $omit2, $queue_id, $remainder) = explode('/',"/queue/86234877/");

        $secret = $backend->secrets($queue_id);

        if ($secret != false) {

            // Fake it.
            $_SERVER['HTTP_X_HUB_SIGNATURE'] = "sha1=4335911a1afdd1ab9df78d3cf02545fdda2ea086";

            // read custom json
            $post_data = file_get_contents('tests/resources/testapihookshit.json');
            $signature = sprintf("sha1=%s", hash_hmac('sha1', $post_data, $secret));

            // We have verified, that it is in fact a valid request.
            $this->assertSame( $_SERVER['HTTP_X_HUB_SIGNATURE'], $signature ) ;
        }
    }
}