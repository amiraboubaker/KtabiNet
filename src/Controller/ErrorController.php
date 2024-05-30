<?php
// src/Controller/ErrorController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorController extends AbstractController
{
    public function handleNotFoundError(): Response
    {
        return $this->render('error/_error.html.twig', [
            'statusCode' => 404,
            'statusText' => 'Page non trouvée',
        ]);
    }

    public function handleInternalError(): Response
    {
        return $this->render('error/_error.html.twig', [
            'statusCode' => 500,
            'statusText' => 'Erreur interne du serveur',
        ]);
    }

    public function fallbackRoute(Request $request): Response
    {
        // Afficher un message personnalisé pour les routes non définies
        return $this->render('error/_error.html.twig', [
            'statusCode' => 404,
            'statusText' => 'La page demandée n\'existe pas.',
        ]);
    }
}
