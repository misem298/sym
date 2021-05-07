<?php

namespace App\Repository;

use App\Entity\Grupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grupe[]    findAll()
 * @method Grupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupe::class);
    }

    // /**
    //  * @return Grupe[] Returns an array of Grupe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grupe
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
