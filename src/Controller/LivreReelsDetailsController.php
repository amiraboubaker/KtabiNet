<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\LivreReel;
use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class LivreReelsDetailsController extends AbstractController
{
    private $entityManager;
    private $security;
    private $session;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, Security $security,  RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }


    #[Route('/LivreReels/{id}', name: 'app_LivreReel')]
    public function index(int $id, Request $request): Response
    {
        $LivreReel = $this->entityManager->getRepository(LivreReel::class)->find($id);

        if (!$LivreReel) {
            throw $this->createNotFoundException('LivreReel non trouvé avec cet ID : ' . $id);
        }

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

        $userEmail = null;
        if ($this->getUser()) {
            $userEmail = $this->getUser()->getEmail();
        }

        $commentaires = $this->entityManager->getRepository(Commentaire::class)->findBy(['IdLivreReel' => $id]);

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
            $commentaire->setIdLivreReel($LivreReel);

            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_LivreReel', ['id' => $id]);
        }

        $session = $request->getSession();

        if ($request->isMethod('POST') && $request->request->has('add_to_cart')) {
            $bookId = $LivreReel->getId();
            $quantity = 1;

            // Retrieve cart items from session (or create an empty cart if it doesn't exist)
            $cart = $session->get('cart', []);

            // Check if the book is already in the cart
            $existingItemKey = array_search($bookId, array_column($cart, 'id'));

            // Update cart data
            if ($existingItemKey !== false) {
                // If book already exists in cart, update the quantity
                $cart[$existingItemKey]['quantity']++;
            } else {
                // If book does not exist in cart, add it
                $cart[] = [
                    'id' => $bookId,
                    'title' => $LivreReel->getTitre(),
                    'price' => $LivreReel->getPrix(),
                    'quantity' => $quantity,
                ];
            }

            $session->set('cart', $cart);
            $this->addFlash('success', 'Livre ajouté au panier avec succès !');

            return $this->redirectToRoute('app_LivreReel', ['id' => $id]);
        }

        return $this->render('Livres/livresReelDetails.html.twig', [
            'LivreReel' => $LivreReel,
            'commentForm' => $form->createView(),
            'commentaires' => $commentaires,
            'user_email' => $userEmail,
            'averageStars' => $averageStars,
            'cart' => $session->get('cart', []),
        ]);
    }
}
