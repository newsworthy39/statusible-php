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
use newsworthy39\Check\Check;
use newsworthy39\Sites\SiteSettings;

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
        $site = Site::FindByIdentifier($args['identifier']);

        if ($site) {
            $response = new Response;
            $response->getBody()->write($this->templates->render('sites/site', ['page' => $page, 'site' => $site]));
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

    public function settings(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $allPostPutVars = $request->getQueryParams();
        $page = isset($allPostPutVars['page']) ? $allPostPutVars['page'] : 'overview';
        $site = Site::FindByIdentifier($args['identifier']);

        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('sites/settings', ['site' => $site, 'page' => $page]));
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


    public function createcheck(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $siteidentifier = $args['identifier'];
        $site = Site::FindByIdentifier($siteidentifier);
        if ($site) {
            $allPostPutVars = $request->getQueryParams();
            // Render a template
            $response = new Response;
            $response->getBody()->write($this->templates->render('sites/checks/create', ['site' => $site]));
            return $response;
        } else {
            throw new NotFoundException('Site not found');
        }
    }

    public function postcreatecheck(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $siteidentifier = $args['identifier'];
        $site = Site::FindByIdentifier($siteidentifier);
        if ($site) {
            $allPostPutVars = $request->getParsedBody();
            $identifier = $allPostPutVars['identifier'];
            $typeofservice = $allPostPutVars['typeofservice'];
            $endpoint = $allPostPutVars['endpoint'];

            $check = Check::Create($identifier, $site, Check::fromString($typeofservice), $endpoint);
            $check->Store();

            // Render a template
            return new RedirectResponse(sprintf("/sites/%s/check/%s", $site->getIdentifier(), $check->getIdentifier()));
        } else {
            throw new NotFoundException('Site not found');
        }
    }

    public function schedulecheck(ServerRequestInterface $request, array $args): ResponseInterface
    {

        $siteidentifier = $args['identifier'];
        $checkidentifier = $args['checkid'];

        if (AuthMiddleware::getUser()) {
            $site = Site::FindByIdentifier($siteidentifier);

            $check = Check::FindByCompositeIdentifier($site, $checkidentifier);

            if ($check) {

                $check->schedulecheck();

                return new RedirectResponse(sprintf("/sites/%s", $site->getIdentifier()));
            } else {
                throw new NotFoundException('Check not found');
            }
        } else {
            return new RedirectResponse(sprintf("/sites/%s", $siteidentifier));
        }
    }
}
