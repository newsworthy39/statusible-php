<?php

declare(strict_types=1);

namespace newsworthy39\Controller;

use newsworthy39\AuthMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;;

class FrontController {

    private $templates;
    public function __construct( \League\Plates\Engine $templates) {
        $this->templates = $templates;

        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
    }

    public function __invoke(ServerRequestInterface $request) : ResponseInterface {
        $params = $request->getQueryParams();

        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('front'));
        return $response;
    }
}