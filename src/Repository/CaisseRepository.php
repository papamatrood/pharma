<?php

namespace App\Repository;

use App\Entity\Caisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Caisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caisse[]    findAll()
 * @method Caisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caisse::class);
    }

    public function findApprovisionnement($motif, $date)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.motif LIKE :motif AND c.dateAt LIKE :date')
            ->setParameter('motif', '%'. $motif .'%')
            ->setParameter('date', '%'. $date .'%')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Caisse[] Returns an array of Caisse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
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
    public function findOneBySomeField($value): ?Caisse
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
