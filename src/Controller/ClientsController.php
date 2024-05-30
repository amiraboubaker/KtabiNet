<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;

use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{

    private $em;
    private $clientRepository;
    // private $em;
     public function __construct(ClientRepository $clientRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->clientRepository = $clientRepository;
     }

    #[Route('/clients', name: 'app_clients')]
    public function index(): JsonResponse
    {
        
         
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClientsController.php',
        ]);
    }


    #[Route('/client/edit/{id}', name: 'app_client_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit($id, Request $request): Response
    {
        $client = $this->clientRepository->find($id);

        // if(!$this->getUser()){
        //     return $this->render('clientBase.html.twig');
        // }

        // if(!$this->getUser() !== $client){
        //     return $this->render('clientBase.html.twig');
        // }
        // dd($client);


        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $client->setNomClient($form->get('NomClient')->getData());
            $client->setPrenomClient($form->get('PrenomClient')->getData());
            $client->setEmail($form->get('email')->getData());
            $client->setNumTel($form->get('NumTel')->getData());

            $newmdp = $form->get('NewPassword')->getData();
            $newcmdp = $form->get('confirmNewPassword')->getData();
            if($newcmdp && $newmdp){
                // MDP a verifier sil correspend au cnfrm mdp
                $client->setPassword(password_hash($form->get('confirmNewPassword')->getData(), PASSWORD_BCRYPT));
               
            }
            $this->em->flush();
            // Route A modifier
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('Client/EditProfile.html.twig', [
            'client' => $client,
            'form' => $form->createView()
        ]);
    }
}
