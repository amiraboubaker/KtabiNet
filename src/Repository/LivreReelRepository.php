<?php

namespace App\Repository;

use App\Entity\LivreReel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LivreReel>
 *
 * @method LivreReel|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivreReel|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivreReel[]    findAll()
 * @method LivreReel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreReelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivreReel::class);
    }

//    /**
//     * @return LivreReel[] Returns an array of LivreReel objects
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

//    public function findOneBySomeField($value): ?LivreReel
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
