<?php

declare(strict_types=1);

namespace newsworthy39;

use newsworthy39\AuthMiddleware;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Http\Exception\ForbiddenException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\Strategy\ApplicationStrategy;
use Zend\Diactoros\Response;

use League\Route\Router;

class WebApplication
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();

        $container = app();

        // Make sure, we try to lookup classes from the container (app)
        $strategy = new ApplicationStrategy;
        $strategy->setContainer($container);
        $this->router->setStrategy($strategy);

        // front-page.
        $this->router->map('GET', '/', \newsworthy39\Controller\FrontController::class);

        // user-stuff.
        $this->router->map('GET', '/user/signin', [\newsworthy39\User\Controller\UserController::class, 'signin']);
        $this->router->map('POST', '/user/signin', [\newsworthy39\User\Controller\UserController::class, 'postsignin']);
        $this->router->map('GET', '/user/signup', [\newsworthy39\User\Controller\UserController::class, 'signup']);
        $this->router->map('POST', '/user/signup', [\newsworthy39\User\Controller\UserController::class, 'postsignup']);
        $this->router->map('GET', '/user/signout', [\newsworthy39\User\Controller\UserController::class, 'signout']);
        $this->router->map('GET', '/token/{id}/resetpassword', [\newsworthy39\User\Controller\UserController::class, 'resetUsingToken']);
        $this->router->map('POST', '/token/{id}/resetpassword', [\newsworthy39\User\Controller\UserController::class, 'postResetUsingToken']);

        // Public stuff
        $this->router->map('GET', '/user/{id}', [\newsworthy39\User\Controller\UserController::class, 'profile']);
        $this->router->map('GET', '/sites/{identifier}', [\newsworthy39\Sites\Controller\SiteController::class, 'index']);
        $this->router->map('GET', '/search', [\newsworthy39\Search\Controller\SearchController::class, 'index']);

        // Profile actions requiring authentication.
        $this->router->group('/user', function (\League\Route\RouteGroup $route) {
            $route->map('GET', '/{id}/settings', [\newsworthy39\User\Controller\UserController::class, 'settings']);
        })->middleware(new AuthMiddleware);

        // Sites requiring authentication
        $this->router->group('/sites', function (\League\Route\RouteGroup $route) {
            $route->map('GET', '/create/new', [\newsworthy39\Sites\Controller\SiteController::class, 'create']);
            $route->map('POST', '/create/new', [\newsworthy39\Sites\Controller\SiteController::class, 'postcreate']);
            $route->map('GET', '/{identifier}/settings', [\newsworthy39\Sites\Controller\SiteController::class, 'settings']);
            $route->map('GET', '/{identifier}/checks', [\newsworthy39\Sites\Controller\SiteController::class, 'index']);
            $route->map('GET', '/{identifier}/checks/new', [\newsworthy39\Sites\Controller\SiteController::class, 'createcheck']);
            $route->map('POST', '/{identifier}/checks/new', [\newsworthy39\Sites\Controller\SiteController::class, 'postcreatecheck']);
            $route->map('DELETE', '/{identifier}', [\newsworthy39\Sites\Controller\SiteController::class, 'delete']);
        })->middleware(new AuthMiddleware);;

        // Media library
        $this->router->group('/media', function (\League\Route\RouteGroup $route) { 
            $route->map('GET', '/',  [\newsworthy39\Media\Controller\MediaController::class, 'index']);
        })->middleware(new AuthMiddleware);
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
            $templates = app()->get(\League\Plates\Engine::class);
            $templates->addData(['user' => AuthMiddleware::getUser()]);
            $response->getBody()->write($templates->render('exception', ['exception' => $exception]));

            return $response;
        } catch (ForbiddenException $exception) {

              // If not found, thow this exception.
              $response = new Response;
              $templates = app()->get(\League\Plates\Engine::class);
              $templates->addData(['user' => AuthMiddleware::getUser()]);
              $response->getBody()->write($templates->render('exception', ['exception' => $exception]));
              return $response;
        }
    }
}
