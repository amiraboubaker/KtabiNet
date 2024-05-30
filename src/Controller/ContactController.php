<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/client/contact', name: 'contact.index')]
    public function index(Request $request,
    EntityManagerInterface $manager,
    MailerInterface $mailer

    ): Response
    {
        $contact = new Contact();
        
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();
            //email
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('admin@ktabinet.com')
            ->subject($contact->getSujet())
            ->htmlTemplate('emails/contact.html.twig')
        
            // pass variables (name => value) to the template
            ->context([
                'contact' => $contact
                
            ]);

        $mailer->send($email);
            $this->addFlash(
                'success',
                'votre demande a été envoyé avec succès !'
            );
            return $this->redirectToRoute('contact.index');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
