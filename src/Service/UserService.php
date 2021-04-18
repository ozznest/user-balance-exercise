<?php


namespace User\Balance\Service;

use  Doctrine\ORM\EntityManagerInterface;
use User\Balance\Entity\User;
use User\Balance\Entity\UserBalance;

class UserService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em )   {

        $this->em = $em;
    }


    public function getUser(int $id):array
    {
        return $this->em->getRepository(User::class)->getUser($id);
    }

    public function getAll():?array
    {
        return $this->em->getRepository(User::class)->getUsers();
    }

    public function getBalance(int $userId):?float
    {
        $balance = $this->em->getRepository(UserBalance::class)->getUserBalance($userId);
        
        return $balance->getBalance();
    }

}
