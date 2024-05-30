<?php

namespace App\Form;

use App\Entity\Acces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date', DateTimeType::class, [
                'widget' => 'single_text',
                'disabled' => true,
            ])
            ->add('Acces', CheckboxType::class, [
                'label' => 'Accès Autorisé',
                'required' => false,
            ])
            ->add('IdClient', null, [
                'disabled' => true,
            ])
            ->add('IdLivrePdf', null, [
                'disabled' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acces::class,
        ]);
    }
}
