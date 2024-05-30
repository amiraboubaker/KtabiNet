<?php

// src/Controller/CommentaireController.php
namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\LivrePdf;
use App\Form\CommentaireType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    #[Route('/livre/{id}/commentaire/add', name: 'commentaire_add')]
    #[IsGranted('ROLE_USER')]
    public function add(Request $request, LivrePdf $livrePdf): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setIdLivrePdf($livrePdf);

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('livre_pdf_details', ['id' => $livrePdf->getId()]);
        }

        return $this->render('livresPdfDetails.html.twig', [
            'livrePdf' => $livrePdf,
            'form' => $form->createView(),
        ]);
    }
}
