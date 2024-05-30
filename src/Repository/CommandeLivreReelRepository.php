<?php

namespace App\Repository;

use App\Entity\CommandeLivreReel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommandeLivreReel>
 *
 * @method CommandeLivreReel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeLivreReel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeLivreReel[]    findAll()
 * @method CommandeLivreReel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeLivreReelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeLivreReel::class);
    }

//    /**
//     * @return CommandeLivreReel[] Returns an array of CommandeLivreReel objects
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

//    public function findOneBySomeField($value): ?CommandeLivreReel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
