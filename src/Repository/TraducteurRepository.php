<?php

namespace App\Repository;

use App\Entity\Traducteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Traducteur>
 *
 * @method Traducteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traducteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traducteur[]    findAll()
 * @method Traducteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraducteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traducteur::class);
    }

//    /**
//     * @return Traducteur[] Returns an array of Traducteur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Traducteur
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
