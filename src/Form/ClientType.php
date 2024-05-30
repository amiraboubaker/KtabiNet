<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'constraints' => [
                    new Assert\Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                        'mode' => 'strict', // Utiliser le mode strict pour une validation plus stricte
                    ]),
                ],
            ])
            ->add('roles')
            ->add('password')
            ->add('NomClient', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z]+$/',
                        'message' => 'Le nom doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('PrenomClient', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z]+$/',
                        'message' => 'Le prénom doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('NumTel', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^(\+)?[0-9]{8,}$/',
                        'message' => 'Veuillez entrer un numéro de téléphone valide.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
