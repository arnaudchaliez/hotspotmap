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

class UserController {

    protected $userRepository;

    public function __construct($repository)
    {
        $this->userRepository = $repository;
    }

    public function usersAction(Request $request, Application $app)
    {
        return $app['helper.response']->handle($this->userRepository->findAll(), 'User/users.html');

        /* return new Response(
            $this->application['rest.serializer']->serialize($this->userRepository->findAll(), 'json')
        ); */
    }


    public function delete($id)
    {
        $user = $this->userRepository->findSatisfying(new ValueSpecification('getId', $id));
        return new Response($this->userRepository->remove($user));
    }

} 