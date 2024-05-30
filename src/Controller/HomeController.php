<?php

namespace App\Controller;

use App\Repository\LivreReelRepository;
use App\Repository\LivrePdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    private $livreReelRepository;
    private $livrePdfRepository;
    private $security;

    public function __construct(LivreReelRepository $livreReelRepository, LivrePdfRepository $livrePdfRepository, Security $security)
    {
        $this->livreReelRepository = $livreReelRepository;
        $this->livrePdfRepository = $livrePdfRepository;
        $this->security = $security;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $livresReel = $this->livreReelRepository->findAll();
        $livresPdf = $this->livrePdfRepository->findAll();

        $NomClient = null;
        if ($this->getUser()) {
            $NomClient = $this->getUser()->getNomClient();
        }

        return $this->render('home/index.html.twig', [
            'livres_reel' => $livresReel,
            'livres_pdf' => $livresPdf,
            'NomClient' => $NomClient,
        ]);
    }

    #[Route('/meslivrespdf', name: 'app_mes_livres_pdf')]
    public function mesLivresPdf(): Response
    {
        $livresPdf = $this->livrePdfRepository->findAll();

        return $this->render('home/MesLivresPdf.html.twig', [
            'livres_pdf' => $livresPdf,
        ]);
    }

    #[Route('/meslivresreel', name: 'app_mes_livres_reel')]
    public function mesLivresReel(): Response
    {
        $livresReel = $this->livreReelRepository->findAll();

        return $this->render('home/MesLivresReel.html.twig', [
            'livres_reel' => $livresReel,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $livresReel = $this->livreReelRepository->findAll();

        return $this->render('home/contact.html.twig', [
            'livres_reel' => $livresReel,
        ]);
    }
    public function findByid(string $query): array // Adjust the return type if needed
    {
        $qb = $this->createQueryBuilder('l');
        $qb->where('LOWER(l.id) LIKE :query')
            ->setParameter('query', "%".strtolower($query)."%");
    
        return $qb->getQuery()->getResult();
    }
    
    // MesLivresReelController.php
    #[Route('/search', name: 'search_route')]
    public function search(Request $request, LivreReelRepository $livreReelRepository): Response
    {
        $query = $request->query->get('query');
    
        if ($query) { // Check if query exists to avoid empty search
            $query = strtolower($query);
            $livres_reel = $livreReelRepository->findByid($query);
        } else {
            $livres_reel = []; // Return empty array if no query provided
        }
    
        return $this->render('home/MesLivresReel.html.twig', [
            'livres_reel' => $livres_reel,
            'searchQuery' => $query
        ]);
    }
}