<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    #[Route('/Client/chatbot', name: 'app_chatbot')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('ChatBot/ChatBot.html.twig');
    }
}
