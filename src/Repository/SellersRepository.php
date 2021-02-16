<?php

namespace App\Repository;

use App\Entity\Sellers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sellers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sellers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sellers[]    findAll()
 * @method Sellers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SellersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sellers::class);
    }

    // /**
    //  * @return Sellers[] Returns an array of Sellers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sellers
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
