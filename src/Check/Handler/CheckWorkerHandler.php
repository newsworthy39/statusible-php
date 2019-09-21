<?php declare(strict_types = 1);

namespace newsworthy39\Check\Handler;

use newsworthy39\Check\Command\CheckWorkerCommand;

class CheckWorkerHandler {

    public function handleCheckWorkerCommand(CheckWorkerCommand $command) {

        $check = $command->getCheck();
        
        // initialize curl, set auth tokens, and download zip-ball.	
        $cl = curl_init($check->getEndpoint());
        
        //curl_setopt($cl, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($cl, CURLOPT_FOLLOWLOCATION , 1);
        curl_setopt($cl, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($cl, CURLOPT_CONNECTTIMEOUT, 2); 
        curl_setopt($cl, CURLOPT_TIMEOUT, 5); //timeout in seconds

        // Set HTTP Header for POST request
        curl_setopt($cl, CURLOPT_HTTPHEADER, array(
            //"Authorization: token $token",
            "User-Agent: statusible.com/1.0.0"
        ));
        $result = curl_exec($cl);
        $httpcode = curl_getinfo($cl, CURLINFO_HTTP_CODE);

        printf("Code is %s\n", $httpcode);

        curl_close($cl);

        $date = date('Y-m-d H:i:s');
        $check->setLastUpdated($date);
        $check->Update();



    }
}