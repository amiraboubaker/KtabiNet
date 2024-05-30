<?php

namespace App\Controller;

use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
    private $em;
    private $conversationRepository;
    // private $em;
     public function __construct(ConversationRepository $conversationRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->conversationRepository = $conversationRepository;
     }

    #[Route('/save-message', name: 'app_save-message')]
    public function save(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Enregistrez le message dans la base de données
        // Exemple :
       
      

        return new JsonResponse(['status' => 'success']);
    }
}
