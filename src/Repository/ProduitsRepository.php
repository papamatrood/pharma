<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }


    public function findAllDisponible()
    {
        $enCours = new \DateTime('now');
        $enCours->modify('+3 months');

        return $this->createQueryBuilder('p')
            ->where('p.datePeremptionAt > :enCours')
            ->setParameter('enCours', $enCours)
            ->orderBy('p.datePeremptionAt', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findAllEncours()
    {
        $now = new \DateTime('now');
        $enCours = new \DateTime('now');
        $enCours->modify('+3 months');

        return $this->createQueryBuilder('p')
            ->where('p.datePeremptionAt < :enCours')
            ->andWhere('p.datePeremptionAt >= :now')
            ->setParameter('enCours', $enCours)
            ->setParameter('now', $now)
            ->orderBy('p.datePeremptionAt', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findAllPerimes()
    {
        $now = new \DateTime('now');

        return $this->createQueryBuilder('p')
            ->where('p.datePeremptionAt < :now')
            ->setParameter('now', $now)
            ->orderBy('p.datePeremptionAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Produits[] Returns an array of Produits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produits
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
