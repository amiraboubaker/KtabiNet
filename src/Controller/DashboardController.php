<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivrePdfRepository;
use App\Repository\LivreReelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DashboardController extends AbstractController
{
    private $em;
    private $clientRepository;
    private $lp;
    private $lr;
    private $commande;
    // private $em;
    public function __construct(private UrlGeneratorInterface $urlGenerator, ClientRepository $clientRepository, EntityManagerInterface $em, LivrePdfRepository $lp, LivreReelRepository $lr, CommandeRepository $commande)
    {
        $this->em = $em;
        $this->lp = $lp;
        $this->lr = $lr;
        $this->commande = $commande;
        $this->clientRepository = $clientRepository;
    }


    #[Route('admin/dashboard', name: 'app_dashboard')]
    // #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
          if(!$this->getUser()){
            return new RedirectResponse($this->urlGenerator->generate('app_home'));
        }
            $commande = $this->commande->findAll();
            $lp = $this->lp->findAll();
            $lr = $this->lr->findAll();
            $clientRepository = $this->clientRepository->findAll();
        
        
            /*************************************** */
            /*************************************** */
            $livrepdf = $this->lp->findAll(); 
            $livresPdfParCategorie = [];

            foreach ($livrepdf as $livre) {
                $categorie = $livre->getCategorie(); 
                if (!isset($livresPdfParCategorie[$categorie])) {
                    $livresPdfParCategorie[$categorie] = 1;
                } else {
                    $livresPdfParCategorie[$categorie]++;
                }
            }
                    // dd($livresPdfParCategorie);
            /*************************************** */
            /*************************************** */


            /*************************************** */
            /*************************************** */
            $livrreel = $this->lr->findAll(); 

            
            $livresReelParCategorie = [];
            foreach ($livrreel as $livre) {
                $categorie = $livre->getCategorie(); 
                if (!isset($livresReelParCategorie[$categorie])) {
                    
                    $livresReelParCategorie[$categorie] = 1;
                } else {
                    $livresReelParCategorie[$categorie]++;
                }
            }
                    // dd($livresReelParCategorie);
            /*************************************** */
            /*************************************** */


            $flousPmois = $this->commande->getTotalPrixByMonthLivrer();

            $cmmndePmois = $this->commande->getNombreCommandesParMois();

            $data = [
                'lp'=> count($lp),
                'lr'=> count($lr),
                'commande'=> count($commande),
                'client'=> count($clientRepository),
                'lpC'=> $livresPdfParCategorie,
                'lrC'=> $livresReelParCategorie,
                'flousPmois'=> $flousPmois,
                'cmdPmois'=> $cmmndePmois,
                'mois' => ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet'],
            'vente' =>[5, 6, 48, 165, 1, 0, 10]];
            $jsonData = json_encode($data);
            // dd($data);
            return $this->render('admin/dashboard/dashboard.html.twig',[
                'data' => $jsonData
            ]);
    }
}
