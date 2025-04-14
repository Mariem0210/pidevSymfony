<?php

namespace App\Repository;

use App\Entity\Certificat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Certificat>
 */
class CertificatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Certificat::class);
    }

    //    /**
    //     * @return Certificat[] Returns an array of Certificat objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Certificat
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findWithRelations(): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.utilisateur', 'u')
            ->addSelect('u')
            ->leftJoin('c.formation', 'f')
            ->addSelect('f')
            ->getQuery()
            ->getResult();
    }

    /**
     * Certificats uniquement pour les utilisateurs de type joueur.
     */
    public function findByJoueur(): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.utilisateur', 'u')
            ->andWhere('u.typeu = :type')
            ->setParameter('type', 'joueur')
            ->addSelect('u')
            ->leftJoin('c.formation', 'f')
            ->addSelect('f')
            ->getQuery()
            ->getResult();
    }
}
