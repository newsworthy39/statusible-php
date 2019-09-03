<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use boxeye\Config;

final class TestAPIHookshot extends TestCase
{
    public function testCandSendGithubHookshots(): void
    {

            // Fake it.

            // get container
            $app = new Config();

            // Parameters passed using a named array:
            $conn = $app->redis();

            $client = new Predis\Client($conn);

            // read custom json
            $post_data = file_get_contents('tests/resources/testapihookshit.json');
            $client->publish('workqueue-github', $post_data);
            echo "Signature-verified Github Hook-shot.";

        
    }
}