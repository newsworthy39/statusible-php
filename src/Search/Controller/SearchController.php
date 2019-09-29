<?php

declare(strict_types=1);

namespace newsworthy39\Search\Controller;

use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response;
use newsworthy39\AuthMiddleware;
use newsworthy39\Sites\Site;
use newsworthy39\Check\Check;
use newsworthy39\Search\Search;

class SearchController
{

    private $templates;
    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;
        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
    }

    public function index(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $allPostPutVars = $request->getQueryParams();
        $q = isset($allPostPutVars['q']) ? $allPostPutVars['q'] : 'nosearch';
        $siteResults = Search::FindSites(array('identifier' => $q));
        $userResults = Search::FindUsers(array('nickname' => $q));

        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('search', ['siteResults' => $siteResults, 'userResults' => $userResults, 'q' => $q]));
        return $response;
    }
}
