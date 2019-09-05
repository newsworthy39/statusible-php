<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

// map a route
$router->map('GET', '/queue/{id}', function (ServerRequestInterface $request) : ResponseInterface {
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

// map a route
$router->map('GET', '/', function (ServerRequestInterface $request) : ResponseInterface {
        $response = new Zend\Diactoros\Response;
        $response->getBody()->write('<h1>Hello, World!</h1>');
        return $response;
    });

$response = $router->dispatch($request);

// send the response to the browser
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

?>

