<?php

declare(strict_types=1);

namespace newsworthy39\Sites\Controller;

use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
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
        $allPostPutVars = $request->getQueryParams();
        $page = isset($allPostPutVars['page']) ? $allPostPutVars['page'] : 'overview';

        // Render a template
        $site = Site::FindByIdentifier($args['id']);
        
        if ($site) {
            $response = new Response;
            $response->getBody()->write($this->templates->render('sites/site', ['page' => $page,'site' => $site]));
            return $response;
        } else {
            throw new NotFoundException('Site not found');
        }
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('sites/create'));
        return $response;
    }

    public function postcreate(ServerRequestInterface $request): ResponseInterface
    {
        $allPostPutVars = $request->getParsedBody();
        $user = AuthMiddleware::getUser();
        if (!$user) {
            return new RedirectResponse("/user/signin");
        }

        $identifier = $allPostPutVars['identifier'];
        $site = Site::FindByIdentifier($identifier);
        if (!$site) {
            $site = Site::Create($identifier, $user);
            $site->Store();
            return new RedirectResponse(sprintf("/sites/%s", $site->getIdentifier()));  
        } else {
            return new RedirectResponse("/sites/create/new?error=occupied");
        }
    }
}
