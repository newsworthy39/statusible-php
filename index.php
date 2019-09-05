<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

// Add elements to container
$container = (new League\Container\Container)->defaultToShared();
$container->add(League\Plates\Engine::class)->addArgument('templates/');
$container->add(League\Route\Router::class);
$container->add(newsworthy39\Config::class);

// Wire different things together.
$router = $container->get(League\Route\Router::class);
$templates = $container->get(League\Plates\Engine::class);
$templates->registerFunction('variables', function($string) use ($container) {
    $config = $container->get(newsworthy39\Config::class);
    return $config->variables($string);
});

// Map some routes, but use json output.
$router->map('GET', '/queue/{id}', function (ServerRequestInterface $request) : ResponseInterface {
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, api!</h1>');
    return $response;
});

$router->map('GET', '/', function (ServerRequestInterface $request) use ($container) : ResponseInterface {

        // Render a template
        $templates = $container->get(League\Plates\Engine::class);
        $response = new Zend\Diactoros\Response;
        $response->getBody()->write($templates->render('front'));
        return $response;
    });

// And dispatch the request.
$response = $router->dispatch($request);

// send the response to the browser
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

?>