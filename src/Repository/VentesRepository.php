<?php

namespace App\Repository;

use App\Entity\Ventes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ventes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ventes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ventes[]    findAll()
 * @method Ventes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ventes::class);
    }
    
    public function findAllWithDate($date)
    {
        return $this->createQueryBuilder('v')
            ->where('v.dateVenteAt LIKE :date')
            ->setParameter(':date', "$date%")
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Ventes[] Returns an array of Ventes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ventes
    {
        return $this->createQueryBuilder('v')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
