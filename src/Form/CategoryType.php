<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z0-9\s\-\'\,\.]+$/',
                        'message' => 'Le titre doit contenir uniquement des lettres, des chiffres, des espaces et des caractères spéciaux (\' \ , . -).',
                    ]),
                ],
            ])
            ->add('description', null, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z0-9\s\-\'\,\.]+$/',
                        'message' => 'La description doit contenir uniquement des lettres, des chiffres, des espaces et des caractères spéciaux (\' \ , . -).',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
