<?php

namespace App\Form;

use App\Entity\LivreReel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class ValidationREELType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le titre ne peut pas être vide']),
                ],
            ])
            ->add('Auteur', TextType::class, [
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
            ->add('Description', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide']),
                ],
            ])
            ->add('Categorie', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La catégorie ne peut pas être vide']),
                ],
            ])
            ->add('NbrPage', IntegerType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nombre de pages ne peut pas être vide']),
                    new Type(['type' => 'integer', 'message' => 'Le nombre de pages doit être un entier']),
                ],
            ])
            ->add('Solde', NumberType::class, [
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
            ->add('Langue', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'La langue ne peut pas être vide']),
                ],
            ])
            ->add('Stock', IntegerType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le stock ne peut pas être vide']),
                    new Type(['type' => 'integer', 'message' => 'Le stock doit être un entier']),
                ],
            ])
            ->add('ImageUrl', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'URL de l\'image ne peut pas être vide']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LivreReel::class,
        ]);
    }

    public function validateDatePublication($value, ExecutionContextInterface $context)
    {
        // Vérifie si la valeur est une chaîne et peut être transformée en objet DateTime
        if (is_string($value)) {
            try {
                new \DateTime($value);
            } catch (\Exception $e) {
                $context->buildViolation('La date de publication doit être une date valide.')
                    ->atPath('DatePublication')
                    ->addViolation();
            }
        }
    }
}
