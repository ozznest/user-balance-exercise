<?php

namespace User\Balance\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use User\Balance\Service\UserService;

class DefaultController extends AbstractController
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    #[Route(
        '/',
        name: 'user_list',
        methods: ['GET']
    )]
    public function index(): Response
    {
        return $this->json(['users' => $this->userService->getAll()]);
    }

    #[Route(
        '/user/{id}',
        name: 'user_info',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function user(int $id): Response
    {

        $user = $this->userService->getUser($id);

        if (!$user) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }

        return $this->json(['user' => $user]);
    }




    #[Route(
    '/info',
    name: 'info'
    )]
    public function info(){
        return new Response(phpinfo(), 200);
    }
}
