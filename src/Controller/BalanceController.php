<?php


namespace User\Balance\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use User\Balance\Service\BalanceService;
use User\Balance\Service\UserService;

class BalanceController extends AbstractController
{
    private $userService;
    private $balanceService;
    public function __construct(UserService $userService, BalanceService $balanceService)
    {
        $this->userService = $userService;
        $this->balanceService = $balanceService;
    }
    #[Route(
        '/balance/{id}/decrease',
        methods: ['PUT'],
        name: 'user_balance_decrease',
        requirements: ['id' => '\d+']
    )]
    public function decreaseBalance(int $id, Request $request): Response
    {
        /** @var \User\Balance\Entity\User $user */
//        if (!$user) {
//            throw $this->createNotFoundException('No user found for id ' . $id);
//        }
        $value = (float) $request->getContent();

        $result = $this->balanceService->decrease($id, $value);

        //return $result ? $this->json(['result' => true]) : $this->json(['result' => false], 400);
        return  $this->json(['result' => $result]);
    }

    #[Route(
        '/balance/{id}/increase',
        name: 'user_balance_increase',
        methods: ['PUT'],
        requirements: ['id' => '\d+']
    )]
    public function increaseBalance(int $id, Request $request): Response
    {
        /** @var \User\Balance\Entity\User $user */

        $value = (float) $request->getContent();

        $balance = $this->balanceService->increase($id, $value);


        return $this->json(['result' => true]);
    }
    #[Route(
        '/balance/{id}',
        name: 'user_balance_get',
        methods: ['GET'],
        requirements: ['id' => '\d+']
    )]
    public function getBalance(int $id){
        $balance = $this->userService->getBalance($id);
        return new Response($balance,200);
    }
}
