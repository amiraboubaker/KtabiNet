<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Data;
use App\Entity\LivrePdf;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireType;
use Symfony\Component\Security\Core\Security;

class LivrePdfDetailsController extends AbstractController
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    private function handleLivreAccess($clientId, $livreId, $categorie)
    {
        // Vérifie si l'utilisateur est connecté
        $user = $this->getUser();

        if ($user) {
            // L'utilisateur est connecté, ajoute les informations à la table Data
            $dataRepository = $this->entityManager->getRepository(Data::class);
            $existingAccess = $dataRepository->findOneBy(['idClient' => $clientId, 'idLivre' => $livreId]);

            if (!$existingAccess) {
                $newData = new Data();
                $newData->setIdClient($clientId);
                $newData->setIdLivre($livreId);
                $newData->setDateConsult(new \DateTime());
                $newData->setCategorieLivre($categorie);
                $this->entityManager->persist($newData);
                $this->entityManager->flush();
            }
        }
    }

    #[Route('/LivrePdf/{id}', name: 'app_LivrePdf')]
    public function index(int $id, Request $request): Response
    {
        $user = $this->getUser();
        // Vérifier si l'utilisateur est connecté
        $LivrePdf = $this->entityManager->getRepository(LivrePdf::class)->find($id);
        if (!$LivrePdf) {
            throw $this->createNotFoundException('LivrePdf non trouvé avec cet ID : ' . $id);
        }
        if ($user) {
            // Récupérer l'ID du client
            $clientId = $user->getId(); // Ou utilisez la méthode appropriée pour récupérer l'ID du client
            // Appeler la méthode pour gérer l'accès au livre
            $this->handleLivreAccess($clientId, $LivrePdf->getId(), $LivrePdf->getCategorie());
        }
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

        $userEmail = null;
        if ($this->getUser()) {
            $userEmail = $this->getUser()->getEmail();
        }

        $commentaires = $this->entityManager->getRepository(Commentaire::class)->findBy(['IdLivrePdf' => $id]);

        // Calculate average stars
        $totalStars = 0;
        foreach ($commentaires as $com) {
            $totalStars += $com->getEvaluation();
        }
        if (count($commentaires) == 0) {
            $averageStars = "nan";
        } else {
            $averageStars = $totalStars / count($commentaires);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $client = $this->entityManager->getRepository(Client::class)->find($user->getId());

            $commentaire->setIdClient($client);
            $commentaire->setDate(new \DateTime());
            $commentaire->setIdLivrePdf($LivrePdf);

            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();


            return $this->redirectToRoute('app_LivrePdf', ['id' => $id]);
        }
        //$commentaires = $this->entityManager->getRepository(Commentaire::class)->findBy(['IdLivrePdf' => $id]);
        return $this->render('Livres/livresPdfDetails.html.twig', [
            'LivrePdf' => $LivrePdf,
            'commentForm' => $form->createView(),
            'commentaires' => $commentaires,
            'user_email' => $userEmail,
            'averageStars' => $averageStars,
        ]);
    }
}
