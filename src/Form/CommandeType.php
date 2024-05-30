<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Ajout de cette ligne
use Symfony\Component\Validator\Constraints as Assert;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateCommande', DateTimeType::class)
            ->add('idClient')
            ->add('prixTotal', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d+(\.\d{1,2})?$/',
                        'message' => 'Le prix total doit être un nombre décimal positif avec au plus deux décimales.'
                    ]),
                ],
            ])
            ->add('NbreLivres', NumberType::class)

            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Livrée' => 'livrée',
                    'Non Livrée' => 'non livrée',
                    'En cours de Livraison' => 'en cours de livraison',
                    'Hors Stock' => 'hors stock',
                ],
                'placeholder' => 'Choisissez un état',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
