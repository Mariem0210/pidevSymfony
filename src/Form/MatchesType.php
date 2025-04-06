<?php

namespace App\Form;

use App\Entity\Matches;
use App\Entity\Tournoi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('equipe1')
            ->add('equipe2')
            ->add('date_debutm', null, [
                'widget' => 'single_text'
            ])
            ->add('status')
            ->add('score')
            ->add('tournoi', EntityType::class, [
                'class' => Tournoi::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matches::class,
        ]);
    }
}
