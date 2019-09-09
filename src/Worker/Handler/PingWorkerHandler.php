<?php declare(strict_types = 1);

namespace newsworthy39\Worker\Handler;

use Predis;
use newsworthy39\Config;
use newsworthy39\Worker\Command\PingWorkerCommand;

class PingWorkerHandler {

    public function handlePingWorkerCommand(PingWorkerCommand $command) {

        // initialize curl, set auth tokens, and download zip-ball.	
        $cl = curl_init($command->url);
        
        //curl_setopt($cl, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($cl, CURLOPT_FOLLOWLOCATION , 1);
        curl_setopt($cl, CURLOPT_NOBODY, true);    // we don't need body

        // Set HTTP Header for POST request
        curl_setopt($cl, CURLOPT_HTTPHEADER, array(
            //"Authorization: token $token",
            "User-Agent: statusible.com/1.0.0"
        ));
        $result = curl_exec($cl);
        $httpcode = curl_getinfo($cl, CURLINFO_HTTP_CODE);

        printf("Code is %s\n", $httpcode);

        curl_close($cl);

        // create a workdir, to our build-context.
        //$downloadfileid = rand(10000,10000000);
        //$workdir = sprintf("work-%d", $downloadfileid);

        // prepare build-environment.
        //mkdir($workdir);
        //chdir($workdir);
        //file_put_contents("$downloadfileid", $result);

        // This allows you to do stuff..
        
        // and nicely, cleanup after ourselves.
        //rrmdir($workdir);

    }
}