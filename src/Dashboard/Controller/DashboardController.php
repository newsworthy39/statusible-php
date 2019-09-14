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

        $this->templates->addData(['signedIn' => true]);
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        // our dashboard are guarded, with the authmiddleware. 
        $user = AuthMiddleware::getUser();

        //$check = Check::Create();
        //$check->assignTo($user);
        //$check->store();

        // get checks.
        $checks = $user->Checks();
        $notifications = 0;
        foreach ($checks as $check) {
            $notifications += $check->getNotifications();
        }

        // Render a template
        $response = new Response;

        $response->getBody()->write($this->templates->render('dashboard/dashboard', ['user' => $user]));
        return $response;
    }
}
