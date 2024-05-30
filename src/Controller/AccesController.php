<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Acces;
use App\Entity\LivrePdf;
use App\Repository\AccesRepository;
use App\Repository\LivrePdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class AccesController extends AbstractController
{
    private $entityManager;
    private $livrePDF;
    private $security;
    private $session;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, LivrePdfRepository $livrePDF, Security $security,  RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->livrePDF = $livrePDF;
        $this->requestStack = $requestStack;
    }
    #[Route('/request-access/{id}', name: 'request_access')]
    #[IsGranted('ROLE_USER')]
    public function requestAccess(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $livrePdf = $entityManager->getRepository(LivrePdf::class)->find($id);

        if (!$livrePdf) {
            throw $this->createNotFoundException('The book does not exist');
        }

        $user = $this->getUser();
        $client = $this->entityManager->getRepository(Client::class)->find($user->getId());

        if ($request->isMethod('POST')) {
            $date = $request->request->get('date');
            $acces = $request->request->get('acces');

            $accesRequest = new Acces();
            $accesRequest->setIdLivrePdf($livrePdf);
            $accesRequest->setDate(new \DateTime($date));
            $accesRequest->setAcces(false);
            $accesRequest->setIdClient($client);


            $entityManager->persist($accesRequest);
            $entityManager->flush();

            $this->addFlash('success', 'Access request submitted successfully.');

            // Redirect to a success page or do something else
            return $this->redirectToRoute('app_LivrePdf', ['id' => $id]);
        }

        return $this->render('acces_livre_pdf/index.html.twig', [
            'livrePdf' => $livrePdf,
        ]);
    }

    #[Route('/lire_livre/{id}', name: 'livre_access')]
    #[IsGranted('ROLE_USER')]
    public function getBooks($id, AccesRepository $accesRepository): Response
    {

        $acces = $accesRepository->getAccesParClient($id);
        $length = count($acces);

        $datalivres = [];
        for ($i = 0; $i < $length; $i++) {
            $datalivre = [];
            $acces1 = $acces[$i];
            if ($acces1->isAcces()) {
                // Faites quelque chose avec chaque objet Acces, par exemple :
                $idLivrePdf = $acces1->getIdLivrePdf();
                $livrePdf = $this->livrePDF->findOneBy(['id' => $idLivrePdf]);

                if ($livrePdf) {
                    $datalivre = [
                        'id' => $livrePdf->getId(),
                        'Titre' => $livrePdf->getTitre(),
                        'Auteur' => $livrePdf->getAuteur(),
                        'Description' => $livrePdf->getDescription(),
                        'Categorie' => $livrePdf->getCategorie(),
                        'NbrPage' => $livrePdf->getNbrPage(),
                        'DatePublication' => $livrePdf->getDatePublication(),
                        'Langue' => $livrePdf->getLangue(),
                        'UrlPdf' => $livrePdf->getUrlPdf(),
                        'UrlImage' => $livrePdf->getUrlImage(),
                    ];
                    // Accéder à la propriété description de LivrePdf
                    $datalivres[$i] = $datalivre;
                    // Afficher la description du LivrePdf

                } else {
                    // Le LivrePdf avec l'ID spécifié n'existe pas
                }
            }
            // dd($livrePdf->getDescription());
            // Affiche l'ID de chaque objet Acces
        }
        // dd($datalivres );  
        return $this->render('client/listeLivreClient.html.twig', [
            'acces' => $datalivres,
        ]);
    }
}
