<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomf')
            ->add('descriptionf')
            ->add('niveauf')
            ->add('dateDebutf', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFinf', null, [
                'widget' => 'single_text',
            ])
            ->add('capacitef')
            ->add('prixf')
            ->add('idu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
