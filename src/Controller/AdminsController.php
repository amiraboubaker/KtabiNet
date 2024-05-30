<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Client;
use App\Form\AddAdminFormType;
use App\Form\AdminFormType;
use App\Form\AdminFromType;
use App\Form\LoginFormType;
use App\Form\RegistrationFormType;
use App\Repository\AdminRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminsController extends AbstractController
{

    private $em;
    private $clientRepository;
    // private $em;
     public function __construct(ClientRepository $clientRepository, EntityManagerInterface $em)
     {
        $this->em =$em;
        $this->clientRepository = $clientRepository;
     }


    #[Route('/admins', name: 'app_admins')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdminsController.php',
        ]);
    }



    #[Route('/admin/edit/{id}', name: 'app_admin_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit($id, Request $request): Response
    {
   
        $admin = $this->clientRepository->find($id);
        // if(!$this->getUser()){
        //     return $this->render('clientBase.html.twig');
        // }

        // if(!$this->getUser() !== $client){
        //     return $this->render('clientBase.html.twig');
        // }
        // dd($client);


        $form = $this->createForm(AdminFormType::class, $admin);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $admin->setNomClient($form->get('NomClient')->getData());
            $admin->setPrenomClient($form->get('PrenomClient')->getData());
            $admin->setEmail($form->get('email')->getData());

            $newmdp = $form->get('password')->getData();
       
            $this->em->flush();
            // Route A modifier
            return $this->render('admin/EditProfile.html.twig', [
                'admin' => $admin,
                'form' => $form->createView()
            ]);
        }

        return $this->render('admin/EditProfile.html.twig', [
            'admin' => $admin,
            'form' => $form->createView()
        ]);
    }

    #[Route('/add/admin', name: 'app_add_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function addAdmin(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(RegistrationFormType::class, $client);

        $form->handleRequest($request);
        // dd($admin->getPassword());

        
        if ($form->isSubmitted() && $form->isValid()) {
            $client->setPassword(password_hash($client->getPassword(), PASSWORD_BCRYPT));
            $client->setNumTel("12345678");
            $client->setRoles(['ROLE_ADMIN']);
            $this->em->persist($client);
            $this->em->flush();

            // Ajout avec succès, vous pouvez rediriger vers une autre page
            return $this->redirectToRoute('app_add_admin'); // Par exemple
        }

        return $this->render('admin/AddAdmin.html.twig', [
            'form' => $form->createView()
        ]);
    }











   
}
