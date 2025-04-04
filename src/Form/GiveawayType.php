<?php

namespace App\Form;

use App\Entity\Giveaway;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiveawayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreg')
            ->add('descg')
            ->add('datedg', null, [
                'widget' => 'single_text',
            ])
            ->add('datefg', null, [
                'widget' => 'single_text',
            ])
            ->add('statusg')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Giveaway::class,
        ]);
    }
}
