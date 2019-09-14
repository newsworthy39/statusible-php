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
    private static $user;
    public static function getUser(): User
    {
        if (is_null(self::$user)) {
            // if user has auth, use the request handler to continue to the next
            // middleware and ultimately reach your route callable
            session_start();
            self::$user = $_SESSION['user'];
        }

        return self::$user;
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
