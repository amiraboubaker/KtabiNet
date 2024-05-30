<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\LivreReel;
use App\Entity\CommandeLivreReel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Commande;
use App\Entity\CommandeLivre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class CommandeLivreReelController extends AbstractController
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

    #[Route('/commande', name: 'app_commande_livre_reel')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        // Retrieve the current request from RequestStack
        $request = $this->requestStack->getCurrentRequest();
        
        // Retrieve cart items from session
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        return $this->render('commande_livre_reel/index.html.twig', [
            'controller_name' => 'CommandeLivreReelController',
            'cart' => $cart,
        ]);
    }
    #[Route('/commande/delete/{id}', name: 'app_commande_livre_reel_delete')]
    #[IsGranted('ROLE_USER')]
    public function deleteFromCart($id): Response
    {
        // Retrieve the current request from RequestStack
        $request = $this->requestStack->getCurrentRequest();

        // Retrieve cart items from session
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        // Find the index of the item to be deleted
        $index = array_search($id, array_column($cart, 'id'));

        // Remove the item from the cart if found
        if ($index !== false) {
            unset($cart[$index]);
            $session->set('cart', array_values($cart)); // Re-index the array
        }

        // Redirect back to the cart page
        return $this->redirectToRoute('app_commande_livre_reel');
    }
    #[Route('/checkout', name: 'app_checkout')]
    #[IsGranted('ROLE_USER')]
    public function checkout(): Response
    {
        // Retrieve cart items from session
        $session = $this->requestStack->getCurrentRequest()->getSession();
        $cart = $session->get('cart', []);

        // Calculate total price and number of books
        $totalPrice = 0;
        $totalBooks = count($cart);
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $user = $this->getUser();
        $client = $this->entityManager->getRepository(Client::class)->find($user->getId());
        
        

            // Create a new Commande entity
            $commande = new Commande();
            $commande->setDateCommande(new \DateTime());
            $commande->setPrixTotal($totalPrice);
            $commande->setNbreLivres($totalBooks);
            $commande->setEtat('Pending'); // Set the initial state as Pending
            $commande->setIdClient($client);

            // Persist the Commande entity to the database
            $this->entityManager->persist($commande);
            $this->entityManager->flush(); // Flush to get the ID of the newly created Commande

            $newCommandeId = $commande->getId();

            // dd($newCommandeId);
    

            // Link book items from cart to the Commande
            // Inside the checkout() method after creating CommandeLivreReel entities
            // Inside the checkout() method after creating CommandeLivreReel entities
            foreach ($cart as $cartItem) {
                $commandeLivreReel = new CommandeLivre();
                $commandeLivreReel->setIdLivre($cartItem['id']);
                
                $commandeLivreReel->setIdCommande($newCommandeId); // Set the Commande entity
                $commandeLivreReel->setQuantity($cartItem['quantity']); // Set the Commande entity
     
                $this->entityManager->persist($commandeLivreReel);
                $this->entityManager->flush();
            }



     
                    

        
        // Clear the cart after checkout
        $session->remove('cart');

        // Redirect to a thank you page or any other appropriate page
        return $this->redirectToRoute('app_home');
    }

    #[Route('/thankyou', name: 'app_thank_you_page')]
    public function thankyou(): Response
    {
        
        return $this->render('commande_livre_reel/thankyou.html.twig', [
            
        ]);
    }
}
