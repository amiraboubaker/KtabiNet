<?php

namespace App\DataFixtures;

use App\Entity\LivreReel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LivreReelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         // Example 1
       $book1 = new LivreReel();
       $book1->setTitre('Atomic Habits');
       $book1->setAuteur('James Clear');
       $book1->setPrix(24.99);
       $book1->setDescription("Atomic Habits explores the power of tiny changes and how they can lead to remarkable results. Written by James Clear, this book delves into the science of habits, providing actionable strategies to build good habits, break bad ones, and master the tiny behaviors that lead to remarkable results.");
       $book1->setCategorie('Self-Help');
       $book1->setNbrPage(320);
       $book1->setSolde(19.99);
       $book1->setDatePublication(new \DateTime('2018-10-16'));
       $book1->setLangue('English');
       $book1->setStock(43);
       $book1->setImageUrl('https://covers.openlibrary.org/b/id/12886417-L.jpg');
       $manager->persist($book1);

       // Example 2
       $book2 = new LivreReel();
       $book2->setTitre('Sapiens: A Brief History of Humankind');
       $book2->setAuteur('Yuval Noah Harari');
       $book2->setPrix(29.99);
       $book2->setDescription("Sapiens: A Brief History of Humankind takes readers on a journey through the history of the human species. Yuval Noah Harari explores the major events that have shaped human evolution and society, providing a thought-provoking perspective on the challenges and achievements of Homo sapiens.");
       $book2->setCategorie('History');
       $book2->setNbrPage(464);
       $book2->setSolde(24.99);
       $book2->setDatePublication(new \DateTime('2014-02-10'));
       $book2->setLangue('English');
       $book2->setStock(23);
       $book2->setImageUrl('https://m.media-amazon.com/images/I/716E6dQ4BXL._AC_UF1000,1000_QL80_.jpg');
       $manager->persist($book2);

       // Example 3
       $book3 = new LivreReel();
       $book3->setTitre('The Subtle Art of Not Giving a F*ck');
       $book3->setAuteur('Mark Manson');
       $book3->setPrix(21.99);
       $book3->setDescription("The Subtle Art of Not Giving a F*ck challenges conventional self-help advice. Mark Manson argues that life's struggles and hardships are inevitable, and it's more important to choose what to care about. This book encourages readers to embrace life's uncertainties and find meaning in the face of adversity.");
       $book3->setCategorie('Self-Help');
       $book3->setNbrPage(224);
       $book3->setSolde(18.99);
       $book3->setDatePublication(new \DateTime('2016-09-13'));
       $book3->setLangue('English');
       $book3->setStock(14);
       $book3->setImageUrl('https://images.epagine.fr/is/5449/9780062457714_1_75.jpg');
       $manager->persist($book3);

       $manager->flush();

        // Example 4
        $book4 = new LivreReel(); 
        $book4->setTitre('The Mountain Is You');
        $book4->setAuteur('Brianna Wiest');
        $book4->setPrix(19.99);
        $book4->setDescription('The Mountain Is You" is a transformative book that delves into the concept of self-sabotage and offers practical guidance on how to overcome it. Written by Brianna Wiest, this empowering read explores the internal obstacles that hinder personal growth and provides insightful strategies to cultivate self-mastery.');
        $book4->setCategorie('Développement personnel');
        $book4->setNbrPage(248 ); 
        $book4->setSolde(5.99); 
        $book4->setDatePublication(new \DateTime('2020-01-01')); 
        $book4->setLangue('Anglais');
        $book4->setStock(51);
        $book4->setImageUrl('https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1590806892i/53642699.jpg'); 
    
        // Enregistrez l'entité dans la base de données
        $manager->persist($book4);
    
        // Flush pour appliquer les changements
        $manager->flush();

        // Example 5
        $book5 = new LivreReel(); 
        $book5->setTitre('Ego Is the Enemy');
        $book5->setAuteur('Ryan Holiday');
        $book5->setPrix(19.99);
        $book5->setDescription("Ego Is the Enemy explains how people tend to think that the world revolves around them. The 'it's all about me' approach comes from the ego, and this thinking distorts failures and successes because the ego is so subjective. When efforts fail, the ego blames everyone else and stresses out.");
        $book5->setCategorie('Développement personnel');
        $book5->setNbrPage(256  ); 
        $book5->setSolde(5.99); 
        $book5->setDatePublication(new \DateTime('2016-06-14')); 
        $book5->setLangue('Anglais');
        $book5->setStock(43);
        $book5->setImageUrl('https://m.media-amazon.com/images/I/71z70m5r7OL._AC_UF1000,1000_QL80_.jpg'); 
    
        // Enregistrez l'entité dans la base de données
        $manager->persist($book5);
    
        // Flush pour appliquer les changements
        $manager->flush();
    }
}
