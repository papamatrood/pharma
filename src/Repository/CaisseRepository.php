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

    public function findApprovisionnement(array $motifs, string $dateAt)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.motif IN (:motifs)')
            ->andWhere('c.dateAt LIKE :dateAt')
            ->setParameter('motifs', array_values($motifs))
            ->setParameter('dateAt', '%' .$dateAt . '%')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findDepense(array $motifs, string $dateAt)
    {        
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Caisse c
            WHERE c.entre = :entre
            AND c.dateAt LIKE :dateAt
            AND c.motif NOT LIKE :motifs
            ORDER BY c.id DESC'
        )
        ->setParameter('entre', 0)
        ->setParameter('dateAt', '%' . $dateAt . '%')
        ->setParameter('motifs', '%' . implode(',', $motifs) . '%');

        // returns an array of Product objects
        return $query->getResult();
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
