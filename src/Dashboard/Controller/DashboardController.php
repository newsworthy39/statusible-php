<?php

declare(strict_types=1);

namespace newsworthy39\Dashboard\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;;

use newsworthy39\Check\Check;
use newsworthy39\AuthMiddleware;


class DashboardController
{
    private $templates;
    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;

        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        // our dashboard are guarded, with the authmiddleware. 
        $user = AuthMiddleware::getUser();



       
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('dashboard'));        
        return $response;
    }
}
