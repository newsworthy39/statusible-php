<?php

declare(strict_types=1);

namespace newsworthy39\Sites\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use newsworthy39\AuthMiddleware;

class SiteController {

    private $templates;
    public function __construct( \League\Plates\Engine $templates) {
        $this->templates = $templates;
        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
    }

    public function index(ServerRequestInterface $request, Array $args) : ResponseInterface {

        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('sites/overview'));
        return $response;
    }
}