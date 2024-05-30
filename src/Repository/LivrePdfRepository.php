<?php

namespace App\Repository;

use App\Entity\LivrePdf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LivrePdf>
 *
 * @method LivrePdf|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivrePdf|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivrePdf[]    findAll()
 * @method LivrePdf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivrePdfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivrePdf::class);
    }

//    /**
//     * @return LivrePdf[] Returns an array of LivrePdf objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LivrePdf
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
