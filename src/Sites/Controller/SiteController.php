<?php

declare(strict_types=1);

namespace newsworthy39\Sites\Controller;

use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use newsworthy39\AuthMiddleware;
use newsworthy39\Sites\Site;

class SiteController
{

    private $templates;
    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;
        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
    }

    public function index(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // Render a template
        $site = Site::Find((int)$args['id']);
        if ($site) {
            $response = new Response;
            $response->getBody()->write($this->templates->render('site', [ 'site' => $site]));
            return $response;
        } else {
            throw new NotFoundException('Site not found');
        }
    }
}
