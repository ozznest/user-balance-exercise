<?php


namespace User\Balance\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use User\Balance\Entity\UserBalance;
use Doctrine\ORM\EntityNotFoundException;
use User\Balance\Exception\OperationNotAllowedException;
use Doctrine\DBAL\LockMode;

class BalanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBalance::class);
    }

    public function getUserBalance(int $userId, bool $withLock=false):UserBalance{
        /* @var $res UserBalance*/
        $query =    $this->createQueryBuilder('b')
            ->andWhere('b.user = :usr_id')
            ->setParameter('usr_id', $userId)
            ->getQuery();
        if($withLock){
            $query->setLockMode(LockMode::PESSIMISTIC_READ);
        }
        $res = $query->getOneOrNullResult()
            ;
        //$res = $this->findOneBy(['user' => $userId]);
        if(is_null($res)) throw new EntityNotFoundException('Entity not found');
        return $res;
    }

    public function increase(int $userId, float $value){
            $this->getEntityManager()->createQuery('UPDATE User\Balance\Entity\UserBalance b
                    SET b.balance=b.balance + :val where b.user=:usr_id')->execute(['usr_id' => $userId, 'val' => $value]);


    }

    public function decrease(int $userId, float $value):bool{

        $connection = $this->getEntityManager()->getConnection();

        $connection->beginTransaction();
        try{
            $balance = $this->getUserBalance($userId, true);

            if($balance->getBalance() - $value < 0){
                throw new OperationNotAllowedException('not enought money');
            }

            $this->getEntityManager()->createQuery('UPDATE User\Balance\Entity\UserBalance b
                    SET b.balance=b.balance - :val where b.user=:usr_id')->execute(['usr_id' => $userId, 'val' => $value]);
            $connection->commit();
        }catch (Exception $e){
            $connection->rollBack();
            return false;
        }
        return true;
    }

}
