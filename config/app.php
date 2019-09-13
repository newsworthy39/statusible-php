<?php

declare(strict_types=1);

use newsworthy39\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\ApplicationStrategy;

function app() : League\Container\Container
{
    static $container;

    if (is_null($container)) {

        $container = (new League\Container\Container)->defaultToShared();

        // default router.
        $container->add(League\Route\Router::class);

        // Add elements to container
        $container->add(League\Plates\Engine::class)->addArgument('templates');
        $container->add(League\Route\Router::class);
        $container->add(Config::class);

        $config = $container->get(Config::class);

        $container
            ->add(\PDO::class)
            ->addArgument('mysql:host=mysql;dbname=test')
            ->addArgument('test')
            ->addArgument('secret')
            ->addArgument(array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION ));

        $container->add(newsworthy39\Factory\Tinker::class)->addArgument(\PDO::class);           

        // Wire different things together.
        $templates = $container->get(League\Plates\Engine::class);
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

        $container->add(newsworthy39\User\Controller\UserController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\Controller\FrontController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\Dashboard\Controller\DashboardController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(newsworthy39\AuthMiddleware::class)->addArgument(\PDO::class);

        
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

        $this->router->map('GET', '/', newsworthy39\Controller\FrontController::class) ;
        $this->router->map('GET', '/user/signin', [ newsworthy39\User\Controller\UserController::class, 'signin']);
        $this->router->map('POST', '/user/signin', [ newsworthy39\User\Controller\UserController::class, 'postsignin']);

        $this->router->map('GET', '/user/signup', [ newsworthy39\User\Controller\UserController::class, 'signup']) ;
        $this->router->map('POST', '/user/signup', [ newsworthy39\User\Controller\UserController::class, 'postsignup']);
        $this->router->map('GET', '/user/signout', [ newsworthy39\User\Controller\UserController::class, 'signout']) ;

        $this->router->map('GET', '/token/{id}/resetpassword', [ newsworthy39\User\Controller\UserController::class, 'resetUsingToken']);
        $this->router->map('POST', '/token/{id}/resetpassword', [ newsworthy39\User\Controller\UserController::class, 'postResetUsingToken']);
       
        $this->router->group('/dashboard', function(\League\Route\RouteGroup $route) {
            $route->map('GET','/', [newsworthy39\Dashboard\Controller\DashboardController::class, 'index']);
        })->middleware(new \newsworthy39\AuthMiddleware);
    }

    /**
     * Controller.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function invoke(ServerRequestInterface $request) : ResponseInterface
    {
        // And dispatch the request.
        return $this->router->dispatch($request);
    }
}
