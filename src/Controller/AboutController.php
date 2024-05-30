<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */
    public function index(): Response
    {
        // Données pour les cards de services
        $services = [
            ['image' => 'real-book.jpg', 'name' => 'Selling Best books', 'description' => 'Le service "Selling Best books" offre une sélection soigneusement choisie des meilleurs livres disponibles. '],
            ['image' => 'ebook.jpeg', 'name' => 'Reading Online books', 'description' => '"Reading Online books" vous offre la possibilité de plonger dans un univers infini de connaissances et de divertissement littéraire sans jamais quitter votre écran.'],
            ['image' => 'Robot.jpeg', 'name' => 'Chatbot', 'description' => 'Notre service de Chatbot est conçu pour vous offrir une expérience client exceptionnelle et personnalisée. '],
            ['image' => 'best-offer.jpg', 'name' => 'Best books ', 'description' => '"Best books" vous propose une sélection exquise des livres les mieux notés et les plus appréciés par les lecteurs du monde entier.'],
        ];

        // Données pour les cards de team members
        $teamMembers = [
            [
                'image' => 'book-coffee.jpg',
                'name' => 'Amira Boubaker',
                'email' => 'amiraboubakeresprims@gmail.com',
                'position' => 'Développeur Web',
            ],
            [
                'image' => 'book-coffee.jpg',
                'name' => 'Md Amine Chakroun',
                'email' => 'AmineChakroun@gmail.com',
                'position' => 'Designer UI/UX',
            ],
            [
                'image' => 'book-coffee.jpg',
                'name' => 'Achraf Hajjar',
                'email' => 'achrafhajjar@gmail.com',
                'position' => 'Data Scientist ',
            ],
            [
                'image' => 'book-coffee.jpg',
                'name' => 'Khawla Abroug',
                'email' => 'KhawlaAbroug@gmail.com',
                'position' => 'Security',
                'image' => 'book-coffee.jpg'
            ],
            [
                'image' => 'book-coffee.jpg',
                'name' => 'Abdesslem Lahouel',
                'email' => 'AbdesslemLahouel@gmail.com',
                'position' => 'Développeur Web',
                'image' => 'book-coffee.jpg'
            ],

        ];

        return $this->render('about/index.html.twig', [
            'services' => $services,
            'teamMembers' => $teamMembers,
        ]);
    }
}
