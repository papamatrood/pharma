<?php

namespace App\Repository;

use App\Entity\Salaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Salaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salaires[]    findAll()
 * @method Salaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salaires::class);
    }

    // /**
    //  * @return Salaires[] Returns an array of Salaires objects
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
    public function findOneBySomeField($value): ?Salaires
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
