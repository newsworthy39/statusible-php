<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use newsworthy39\Config;
use newsworthy39\Queue;
use newsworthy39\User\User;
use newsworthy39\Worker\Command\PingWorkerCommand;
use newsworthy39\Event\UserSignupEvent;


$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$container = Config::container();

// Wire different things together.
$router = $container->get(League\Route\Router::class);
$templates = $container->get(League\Plates\Engine::class);
$templates->registerFunction('variables', function ($string) use ($container) {
    $config = $container->get(newsworthy39\Config::class);
    return $config->variables($string);
});

$router->map('GET', '/', function (ServerRequestInterface $request) use ($container): ResponseInterface {
    $params = $request->getQueryParams();
    
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
    $user = User::create($_POST['email']);
    $command = new UserSignupEvent($user);
    $queue->publish($command);

    return $response;
});

$router->map('GET', '/user/{id}/resetpassword', function (ServerRequestInterface $request, array $args) use ($container): ResponseInterface {

    // verify email and token.
    $uuid = $args['id'];
    $params = $request->getQueryParams();

    $user = User::load($uuid);
    if ($user && $user->token == $params['token']) {
        // if ok, assume user is logged in, and show reset-password-form.
        $templates = $container->get(League\Plates\Engine::class);
        $response = new Zend\Diactoros\Response;
        $response->getBody()->write($templates->render('resetpassword'));
        return $response;
    } else {
        $response = new Zend\Diactoros\Response\RedirectResponse('/?error=notokenoremail');
        return $response;
    }    
});

$router->map('POST', '/user/{id}/resetpassword', function (ServerRequestInterface $request, array $args) use ($container): ResponseInterface {
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
