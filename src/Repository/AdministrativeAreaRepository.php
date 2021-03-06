<?php

namespace App\Repository;

use App\Entity\AdministrativeArea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdministrativeArea|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdministrativeArea|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdministrativeArea[]    findAll()
 * @method AdministrativeArea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdministrativeAreaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdministrativeArea::class);
    }

    public function getAll(): QueryBuilder
    {
        return $this->createQueryBuilder('aa');
    }

    /**
     * @param string $search
     * @return QueryBuilder
     */
    public function getByName(string $search): QueryBuilder
    {
        return $this->createQueryBuilder('aa')
            ->where('aa.name like :search')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('aa.name', 'ASC')
            ->setMaxResults(10);
    }

    /**
     * @param string $search
     * @return AdministrativeArea[]
     */
    public function findByName(string $search)
    {
        return $this->getByName($search)->getQuery()->getResult();
    }

    // /**
    //  * @return AdministrativeArea[] Returns an array of AdministrativeArea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdministrativeArea
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
