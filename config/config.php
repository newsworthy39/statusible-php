<?php

declare(strict_types=1);

use newsworthy39\AuthMiddleware;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\ApplicationStrategy;
use Zend\Diactoros\Response;
use League\Route\Router;
use League\Container\Container;

function configurations(): array
{
	$configurations = [
		'githubaccesstoken' => 'eae69c067063f5eb3de450739a38eca6ee6cc74c'
	];

	return $configurations;
}


function variables($key)
{
	$config = [
		'site_title' => $_SERVER['HTTP_HOST']
	];

	return $config[$key];
}

function app(): Container
{
    static $container;

    if (is_null($container)) {

        $container = (new Container)->defaultToShared();

        // Add elements to container
        $container->add(\League\Plates\Engine::class)->addArgument('templates');
        $container
            ->add(\PDO::class)
            ->addArgument('mysql:host=mysql;dbname=test')
            ->addArgument('test')
            ->addArgument('secret')
            ->addArgument(array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

        $container->add(\newsworthy39\Factory\Tinker::class)->addArgument(\PDO::class);

        // Wire different things together.
        $templates = $container->get(\League\Plates\Engine::class);
        $templates->registerFunction('variables', function ($string) {
            return variables($string);
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
        $container->add(\newsworthy39\User\Controller\UserController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(\newsworthy39\Controller\FrontController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(\newsworthy39\Dashboard\Controller\DashboardController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(\newsworthy39\Sites\Controller\SiteController::class)->addArgument(\League\Plates\Engine::class);
        $container->add(\newsworthy39\AuthMiddleware::class);

        // self::$container->add(pdo...)
        // self::$container->add(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
        //self::$container->add(ORMlayer)->withArgument(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
        // now get ORMlayer.
    }

    return $container;
}

