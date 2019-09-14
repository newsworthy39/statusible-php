<?php

declare(strict_types=1);

namespace newsworthy39\User\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;;

use newsworthy39\Queue;
use newsworthy39\User\User;
use newsworthy39\User\Event\UserSignupEvent;
use newsworthy39\User\Event\UserSigninEvent;
use newsworthy39\AuthMiddleware;

class UserController
{
    private $templates;
    public function __construct(\League\Plates\Engine $templates)
    {
        $this->templates = $templates;

        $this->templates->addData(['user' => AuthMiddleware::getUser()]);
          
    }

    public function resetUsingToken(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // verify email and token.
        $token = $args['id'];
        $params = $request->getQueryParams();

        $user = User::FindUsingToken($token);
        if ($user) {
            // if ok, assume user is logged in, and show reset-password-form.
            $response = new Response;
            $response->getBody()->write($this->templates->render('resetpassword', ['token' => $user->token]));
            return $response;
        } else {
            $response = new RedirectResponse('/?error=notokenoremail');
            return $response;
        }
    }

    public function postResetUsingToken(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // if ok, assume user is logged in, and show reset-password-form.

        // verify email and token.
        $token = $args['id'];
        $user = User::FindUsingToken($token);
        if ($user) {
            $allPostPutVars = $request->getParsedBody();
            foreach ($allPostPutVars as $key => $param) {
                $user->$key = $param;
            }

            // set password to sha1, rather important.
            $user->password = sha1($user->password);

            // update token
            $user->generateToken();

            // update user.
            $user->Update();
        }

        $response = new RedirectResponse('/user/signin');
        return $response;
    }

    public function signup(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('signup'));
        return $response;
    }

    public function postsignup(ServerRequestInterface $request): ResponseInterface
    {
        // verify email and token.
        $allPostPutVars = $request->getParsedBody();
        $user = User::Find($allPostPutVars['email']);

        if ($user == false) {

            $queue = new Queue();
            $user = User::create($allPostPutVars);

            $user->Store();

            // send event.
            $command = new UserSignupEvent($user);
            $queue->publish($command);
        }

        // Render a response
        $response = new RedirectResponse('/');
        return $response;
    }


    public function signin(ServerRequestInterface $request): ResponseInterface
    {
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('signin'));
        return $response;
    }

    public function postsignin(ServerRequestInterface $request): ResponseInterface
    {
        // verify email and token.
        $allPostPutVars = $request->getParsedBody();
        $user = User::Find($allPostPutVars['email']);

        if ($user != false && $user->password == sha1($allPostPutVars['password'])) {
            $queue = new Queue();
            $command = new UserSigninEvent($user);
            $queue->publish($command);

            session_start();

            $_SESSION['user'] = $user;

            # write and close current session
            session_write_close();

            // Render a response
            $response = new RedirectResponse('/dashboard');
            return $response;
        } else {

            // Render a response
            $response = new RedirectResponse('/');
            return $response;
        }
    }

    public function signout(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        session_destroy();

        $_SESSION = array();

        // Render a response
        $response = new RedirectResponse('/');
        return $response;
    }
}
