<?php

declare(strict_types=1);

namespace newsworthy39;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use newsworthy39\User\User;

class AuthMiddleware implements MiddlewareInterface
{
    public static function getUser()
    {
        if (session_id() == '' || !isset($_SESSION)) {
            // session isn't started, so start one.
            session_start();
        }

        // If a user-object exists, 
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }


        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // determine authentication and/or authorization
        // ...

        $user = self::getUser();

        if ($user != false) {
            return $handler->handle($request);
        }

        // if user does not have auth, possibly return a redirect response,
        // this will not continue to any further middleware and will never
        // reach your route callable
        return new RedirectResponse('/');
    }
}
