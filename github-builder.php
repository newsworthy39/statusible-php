<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

function rrmdir($path) {
     // Open the source directory to read in files
        $i = new DirectoryIterator($path);
        foreach($i as $f) {
            if($f->isFile()) {
                unlink($f->getRealPath());
            } else if(!$f->isDot() && $f->isDir()) {
                rrmdir($f->getRealPath());
            }
        }
        rmdir($path);
}

// get container
$app = new Config();

// Parameters passed using a named array:
$conn = $app->redis();
$redis = new Predis\Client($conn + array('read_write_timeout' => 0));
$pubsub = $redis->pubSubLoop();

// Subscribe to your channels
$pubsub->subscribe('control_channel', 'workqueue-github');

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

		// This is technically, a github-downloader-archive-downloader.
		// "archive_url": "https://api.github.com/repos/newsworthy39/moonly-network-php-api/{archive_format}{/ref}"
		$id = $payload->head_commit->id;
		$token = $app->githubaccesstoken();
		$archive_url = sprintf("%s/%s/%s", substr($payload->repository->archive_url, 0,
			       strlen($payload->repository->archive_url) - 23), 'zipball', $id);

		// initialize curl, set auth tokens, and download zip-ball.	
		$cl = curl_init($archive_url);
		curl_setopt($cl, CURLOPT_HTTPHEADER, array("Authorization: $token"));
		curl_setopt($cl, CURLOPT_RETURNTRANSFER , 1);
		curl_setopt($cl, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($cl, CURLOPT_USERAGENT,'User-Agent: curl/7.64.0');

		// Set HTTP Header for POST request
		curl_setopt($cl, CURLOPT_HTTPHEADER, array(
			"Authorization: token $token",
			"User-Agent: curl/7.64.0"
		));
		$result = curl_exec($cl);
		curl_close($cl);

		// create a workdir, to our build-context.
		$downloadfileid = rand(10000,10000000);
		$workdir = sprintf("work-%d", $downloadfileid);

		// prepare build-environment.
		mkdir($workdir);
		file_put_contents("$downloadfileid.zip", $result);

		$zip = new ZipArchive;
		$res = $zip->open("$downloadfileid.zip");
		if ($res === TRUE) {
		    $zip->extractTo($workdir);
		    $zip->close();
		    unlink("$downloadfileid.zip");
		} else {
		    rrmdir($workdir);
		    return true;
		}


		// containers, relying on this, should be built now.
		// prepare some github-to-bash variables, to make it easier to read.
		$fullname = $payload->repository->full_name;
		$folder = sprintf("%s/%s-%s", $workdir, str_replace('/','-', $fullname), $id);
		$imagename = sprintf("%s:%s", $fullname, $id);
		$containername = explode('/', $fullname)[1];

		// launch build-system, with defaults.
		system(sprintf("cd %s && docker build -t %s .", $folder, $imagename));
		system(sprintf("docker tag %s %s:latest", $imagename, $fullname));
		
		// We could technically, allow for a local registry-server, w/ docker here.
		// https://docs.docker.com/registry/deploying/
		
		// and nicely, cleanup after ourselves.
		rrmdir($workdir);

		// Notify deploy-mechanism.
		//
		// Parameters passed using a named array:
		$conn = $app->redis();
		$r1 = new Predis\Client($conn + array('read_write_timeout' => 0));
		$r1->publish('workqueue-github-completed', json_encode(array('id' => $id)));
		$r1->unsubscribe();
            }
            break;
    }
}

?>

