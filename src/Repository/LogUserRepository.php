<?php

namespace App\Repository;

use App\Entity\LogUser;
use App\Enum\LogActionEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LogUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogUser[]    findAll()
 * @method LogUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogUser::class);
    }

    public function findRemoveActionLog(LogUser $log)
    {
        return $this->createQueryBuilder('l')
            ->where('l.targetEntity = :targetEntity')
            ->andWhere('l.targetEntityType = :targetEntityType')
            ->andWhere('l.action = :action')
            ->setParameter('targetEntity', $log->getTargetEntity())
            ->setParameter('targetEntityType', $log->getTargetEntityType())
            ->setParameter('action', LogActionEnum::REMOVE)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return LogUser[] Returns an array of LogUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LogUser
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
