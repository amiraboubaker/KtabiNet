<?php

namespace App\Form;

use App\Entity\LivrePdf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ValidationPDFType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Le titre ne peut pas être vide']),
                ],
            ])
            ->add('Auteur', null, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'auteur ne peut pas être vide']),
                ],
            ])
            ->add('Prix', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Le prix ne peut pas être vide']),
                    new Type(['type' => 'float', 'message' => 'Le prix doit être un nombre']),
                ],
            ])
            ->add('Description', null, [
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide']),
                ],
            ])
            ->add('Categorie', null, [
                'constraints' => [
                    new NotBlank(['message' => 'La catégorie ne peut pas être vide']),
                ],
            ])
            ->add('NbrPage', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nombre de pages ne peut pas être vide']),
                    new Type(['type' => 'integer', 'message' => 'Le nombre de pages doit être un entier']),
                ],
            ])
            ->add('Solde', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Le solde ne peut pas être vide']),
                    new Type(['type' => 'float', 'message' => 'Le solde doit être un nombre']),
                ],
            ])
            ->add('DatePublication', null, [
                'constraints' => [
                    new NotBlank(['message' => 'La date de publication ne peut pas être vide']),
                    new Type(['type' => '\DateTimeInterface', 'message' => 'La date de publication doit être une date']),
                ],
            ])
            ->add('langue', null, [
                'constraints' => [
                    new NotBlank(['message' => 'La langue ne peut pas être vide']),
                ],
            ])
            ->add('UrlPdf', null, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'URL du PDF ne peut pas être vide']),
                ],
            ])
            ->add('UrlImage', null, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'URL de l\'image ne peut pas être vide']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LivrePdf::class,
        ]);
    }
}
