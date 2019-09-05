<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Router;
use League\Plates\Engine;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$container = (new League\Container\Container)->defaultToShared();
$container->add(League\Plates\Engine::class)->addArgument('templates/');
$container->add(League\Route\Router::class);
$container->add(newsworthy39\Config::class);

$router = $container->get(League\Route\Router::class);
$templates = $container->get(League\Plates\Engine::class);
$templates->registerFunction('variables', function($string) use ($container) {
    $config = $container->get(newsworthy39\Config::class);
    return $config->variables($string);
});

// map a route
$router->map('GET', '/queue/{id}', function (ServerRequestInterface $request) : ResponseInterface {
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, api!</h1>');
    return $response;
});

// map a route
$router->map('GET', '/', function (ServerRequestInterface $request) use ($container) : ResponseInterface {

        // Render a template
        $templates = $container->get(League\Plates\Engine::class);
        $response = new Zend\Diactoros\Response;
        $response->getBody()->write($templates->render('front', ['name' => $_SERVER['HTTP_X_FORWARDED_FOR']]));
        return $response;
    });

$response = $router->dispatch($request);

// send the response to the browser
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

?>