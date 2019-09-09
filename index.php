<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use newsworthy39\Queue;
use newsworthy39\Worker\Command\PingWorkerCommand;
use newsworthy39\Worker\Command\SignupWorkerCommand;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Add elements to container
$container = (new League\Container\Container)->defaultToShared();
$container->add(League\Plates\Engine::class)->addArgument('templates/');
$container->add(League\Route\Router::class);
$container->add(newsworthy39\Config::class);

// Wire different things together.
$router = $container->get(League\Route\Router::class);
$templates = $container->get(League\Plates\Engine::class);
$templates->registerFunction('variables', function ($string) use ($container) {
    $config = $container->get(newsworthy39\Config::class);
    return $config->variables($string);
});

$router->map('GET', '/', function (ServerRequestInterface $request) use ($container): ResponseInterface {
    // Render a template
    $templates = $container->get(League\Plates\Engine::class);
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write($templates->render('front'));
    return $response;
});

$router->map('GET', '/signup', function (ServerRequestInterface $request) use ($container): ResponseInterface {
    // Render a template
    $templates = $container->get(League\Plates\Engine::class);
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write($templates->render('signup'));
    return $response;
});

$router->map('POST', '/signup', function (ServerRequestInterface $request) use ($container): ResponseInterface {

    // Render a response
    $response = new Zend\Diactoros\Response\RedirectResponse('/');

    // Send to queue.
    $queue = new Queue();
    $command = new SignupWorkerCommand($_POST['email']);
    $queue->publish($command);

    return $response;
});

$router->map('GET', '/resetpassword', function (ServerRequestInterface $request) use ($container): ResponseInterface {

    // verify email and token.
    $email = $_GET['email'];
    $token = $_GET['token'];

    // if not, redirect to frontpage
    if (isset($email) || isset($token)) {
        $response = new Zend\Diactoros\Response\RedirectResponse('/?error=notokenoremail');
        return $response;
    }

    // if ok, assume user is logged in, and show reset-password-form.
    $templates = $container->get(League\Plates\Engine::class);
    $response = new Zend\Diactoros\Response;
    $response->getBody()->write($templates->render('resetpassword'));
    return $response;
});

$router->map('POST', '/resetpassword', function (ServerRequestInterface $request) use ($container): ResponseInterface {
    // if ok, assume user is logged in, and show reset-password-form.

    $response = new Zend\Diactoros\Response\RedirectResponse('/dashboard');
    return $response;
});

$router->map('POST', '/api/job/{uri}', function (ServerRequestInterface $request, array $args) use ($container): ResponseInterface {

    $uri = $args['uri'];

    if (!isset($uri)) {
        $uri = 'www.bt.dk';
    }

    // Render a response
    $response = new Zend\Diactoros\Response\RedirectResponse('/');

    // Send to queue.
    $queue = new Queue();
    $command = new PingWorkerCommand(sprintf('https://%s', $args['uri']));
    $queue->publish($command);

    return $response;
});

// And dispatch the request.
$response = $router->dispatch($request);

// send the response to the browser
(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
