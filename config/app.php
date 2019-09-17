<?php

declare(strict_types=1);

use newsworthy39\Config;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\ApplicationStrategy;
use Zend\Diactoros\Response;

function app(): League\Container\Container
{
    static $container;

    if (is_null($container)) {

        $container = (new League\Container\Container)->defaultToShared();

        // Add elements to container
        $container->add(League\Plates\Engine::class)->addArgument('templates');
        $container->add(Config::class);
        $container
            ->add(\PDO::class)
            ->addArgument('mysql:host=mysql;dbname=test')
            ->addArgument('test')
            ->addArgument('secret')
            ->addArgument(array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

        $container->add(newsworthy39\Factory\Tinker::class)->addArgument(\PDO::class);

        // Wire different things together.
        $templates = $container->get(League\Plates\Engine::class);
        $config = $container->get(Config::class);
        $templates->registerFunction('variables', function ($string) use ($config) {
            return $config->variables($string);
        });

        // redis
        $container->add(\Predis\Client::class, function () {
            $config = array(
                'scheme' => 'tcp',
                'host'   => 'redis',
                'port'   => 6379,
                'persistent' => false,
                'read_write_timeout' => 0,
            );

            // Parameters passed using a named array:
            return new Predis\Client($config);
        });

        // Controllers, for route lookup w/ dependency injection.
        $container->add(newsworthy39\User\Controller\UserController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\Controller\FrontController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\Dashboard\Controller\DashboardController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\Sites\Controller\SiteController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\AuthMiddleware::class);

        // self::$container->add(pdo...)
        // self::$container->add(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
        //self::$container->add(ORMlayer)->withArgument(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
        // now get ORMlayer.
    }

    return $container;
}

class WebApplication
{
    private $router;

    public function __construct()
    {
        $this->router = new League\Route\Router();

        $container = app();

        // Make sure, we try to lookup classes from the container (app)
        $strategy = new ApplicationStrategy;
        $strategy->setContainer($container);
        $this->router->setStrategy($strategy);

        $this->router->map('GET', '/', newsworthy39\Controller\FrontController::class);

        $this->router->map('GET', '/user/signin', [newsworthy39\User\Controller\UserController::class, 'signin']);
        $this->router->map('POST', '/user/signin', [newsworthy39\User\Controller\UserController::class, 'postsignin']);

        $this->router->map('GET', '/user/signup', [newsworthy39\User\Controller\UserController::class, 'signup']);
        $this->router->map('POST', '/user/signup', [newsworthy39\User\Controller\UserController::class, 'postsignup']);
        $this->router->map('GET', '/user/signout', [newsworthy39\User\Controller\UserController::class, 'signout']);
        $this->router->map('GET', '/token/{id}/resetpassword', [newsworthy39\User\Controller\UserController::class, 'resetUsingToken']);
        $this->router->map('POST', '/token/{id}/resetpassword', [newsworthy39\User\Controller\UserController::class, 'postResetUsingToken']);

        // Public profile
        $this->router->group('/user', function (\League\Route\RouteGroup $route) {
            $route->map('GET', '/{id}', [newsworthy39\User\Controller\UserController::class, 'profile']);
        });

        // Profile actions requiring authentication.
        $this->router->group('/user', function (\League\Route\RouteGroup $route) {
            $route->map('GET', '/{id}/dashboard', [newsworthy39\User\Controller\UserController::class, 'dashboard']);
            $route->map('GET', '/{id}/settings', [newsworthy39\User\Controller\UserController::class, 'settings']);
        })->middleware(new newsworthy39\AuthMiddleware);


        // Sites requiring authentication
        $this->router->group('/sites', function (\League\Route\RouteGroup $route) {
            $route->map('GET', '/create/new', [newsworthy39\Sites\Controller\SiteController::class, 'create']);
            $route->map('POST', '/create/new', [newsworthy39\Sites\Controller\SiteController::class, 'postcreate']);
            $route->map('GET', '/{id:word}/settings', [newsworthy39\Sites\Controller\SiteController::class, 'settings']);
        })->middleware(new newsworthy39\AuthMiddleware);;

        // Public sites
        $this->router->map('GET', '/sites/{id:word}', [newsworthy39\Sites\Controller\SiteController::class, 'index']);
    }

    /**
     * Controller.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function invoke(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // And dispatch the request.
            return $this->router->dispatch($request);
        } catch (NotFoundException $exception) {
            // If not found, thow this exception.
            $response = new Response;
            $templates = app()->get(League\Plates\Engine::class);

            // But never create session on 404-pages! (just-imagine!)
            $templates->addData(['user' => false]);
            $response->getBody()->write($templates->render('notfound', ['exception' => $exception]));

            return $response;
        }
    }
}
