<?php
/**
 * File: UserController.php
 * Date: 11/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    protected $userRepository;

    public function __construct($repository)
    {
        $this->userRepository = $repository;
    }

    public function usersAction(Request $request, Application $app)
    {
        return $app['helper.response']->handle($this->userRepository->findAll(), 'User/users.html');
    }

    public function loginAction(Request $request, Application $app)
    {
        extract($request->attributes);
        if (isset($username) && isset($password))
        {
            //todo check
            //todo session
        }
        else {
            return $app['helper.response']->handle('username and password required', 'User/login.html', 400);
        }

        return $app['helper.response']->handle('', 'index.html');
    }

    public function logoutAction(Request $request, Application $app)
    {
        extract($request->attributes);
        if (isset($username) && isset($password))
        {
            //todo check
            //todo session
        }

        return $app['helper.response']->handle('', 'index.html');
    }

    public function deleteAction($id)
    {
        $user = $this->userRepository->findSatisfying(new ValueSpecification('getId', $id));
        return new Response($this->userRepository->remove($user));
    }

} 