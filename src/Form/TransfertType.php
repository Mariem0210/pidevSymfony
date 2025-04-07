<?php

namespace App\Form;

use App\Entity\Transfert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Positive;

class TransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idu')
            ->add('ancienne_equipe')
            ->add('nouvelle_equipe')
            ->add('montantt', NumberType::class, [
                'constraints' => [
                    new Positive([
                        'message' => 'Le montant doit être positif'
                    ])
                ],
                'attr' => [
                    'min' => 0.01,
                    'step' => '0.01',
                    'required' => true
                ]
            ])
            ->add('datet', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transfert::class,
        ]);
    }
}