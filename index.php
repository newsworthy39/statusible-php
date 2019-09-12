<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Wire different things together.

$app = new WebApplication();

// And dispatch the request.
$response = $app->invoke($request);

// send the response to the browser
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
