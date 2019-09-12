<?php

declare(strict_types=1);

namespace newsworthy39\Dashboard\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use newsworthy39\User\User;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;;

use newsworthy39\Queue;
use newsworthy39\Event\UserSignupEvent;

class DashboardController
{
    private $templates;
    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {

        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('dashboard/dashboard'));
        return $response;
    }
}
