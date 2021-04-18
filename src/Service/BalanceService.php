<?php


namespace User\Balance\Service;


use Doctrine\ORM\EntityManagerInterface;
use User\Balance\Entity\UserBalance;

class BalanceService
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
       $this->em = $em;
    }

    public function increase(int $userId, float $value){
        $this->em->getRepository(UserBalance::class)->increase($userId, $value);
    }

    public function decrease(int $userId, float $value):bool{

        return $this->em->getRepository(UserBalance::class)->decrease($userId, $value);
    }
}
