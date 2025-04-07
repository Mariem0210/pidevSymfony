<?php

namespace App\Form;

use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomt')
            ->add('descriptiont')
            ->add('date_debutt', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fint', null, [
                'widget' => 'single_text',
            ])
            ->add('nbr_equipes')
            ->add('prixt')
            ->add('statutt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
