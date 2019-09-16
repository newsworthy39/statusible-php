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
            return $response->getBody()->write($this->templates->render('resetpassword', ['token' => $user->token]));
        } else {
            return new RedirectResponse('/?error=notokenoremail');
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
            
            // set password to sha1, rather important.
            $user->SetPassword($allPostPutVars['password']);

            // update token
            $user->generateToken();

            // update user.
            $user->Update();
        }

        return new RedirectResponse('/user/signin');
    }

    /**
     * Signup-function. 
     * This function, renders the signup 
     * template, with an optional plan-extraction
     * from uri/?plan=[]
     */
    public function signup(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $queryparams    = $request->getQueryParams();
        $selectedplan = 'starter';
        if (isset($queryparams['plan'])) {
            $selectedplan = $queryparams['plan'];
        }

        $response = new Response;
        $this->templates->addData(['plan' => $selectedplan]);
        return $response->getBody()->write($this->templates->render('signup'));
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
        return new RedirectResponse('/');
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

            if (session_id() == '' || !isset($_SESSION)) {
                // session isn't started, so start one.
                session_start();
            }

            $_SESSION['user'] = $user;

            # write and close current session
            session_write_close();

            // Render a response
            return new RedirectResponse(sprintf("/user/%s/dashboard", $user->Nickname()));
        } else {
            // make sure, we kill our session, 
            return $this->signout($request);
        }
    }

    public function signout(ServerRequestInterface $request): ResponseInterface
    {
        if (session_id() == '' || !isset($_SESSION)) {
            // session isn't started, so start one.
            session_start();
        }
        session_destroy();

        $_SESSION = array();

        // Render a response
        return new RedirectResponse('/');
    }

    public function profile(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('profile'));
        return $response;
    }

    public function settings(ServerRequestInterface $request, array $args): ResponseInterface
    {
        // Render a template
        $response = new Response;
        $response->getBody()->write($this->templates->render('settings'));
        return $response;
    }
}
