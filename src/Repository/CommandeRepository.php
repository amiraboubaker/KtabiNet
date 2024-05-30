<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

//    /**
//     * @return Commande[] Returns an array of Commande objects
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
public function getTotalPrixByMonthLivrer()
{
    
  
    $commandes = $this->createQueryBuilder('c')
    ->select('c.DateCommande, c.prixTotal')
    ->where('c.etat = :etat')
    ->setParameter('etat', 'livrée')
    ->getQuery()
    ->getResult();

    $totalPrixByMonth = [];

    foreach ($commandes as $commande) {
        $mois = $commande['DateCommande']->format('m');
        $prixTotal = $commande['prixTotal'];

        if (!isset($totalPrixByMonth[$mois])) {
            $totalPrixByMonth[$mois] = 0;
        }

        $totalPrixByMonth[$mois] += $prixTotal;
    }
    return $totalPrixByMonth;
}
public function getNombreCommandesParMois()
{
    $commandes = $this->createQueryBuilder('c')
        ->select('c.DateCommande')
        ->getQuery()
        ->getResult();

    $nombreCommandesParMois = [];

    foreach ($commandes as $commande) {
        $mois = $commande['DateCommande']->format('m');

        if (!isset($nombreCommandesParMois[$mois])) {
            $nombreCommandesParMois[$mois] = 0;
        }

        $nombreCommandesParMois[$mois]++;
    }

    return $nombreCommandesParMois;
}

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
