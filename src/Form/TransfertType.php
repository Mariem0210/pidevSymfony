<?php

namespace App\Form;

use App\Entity\Transfert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;

class TransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idu', null, [
                // Aucune contrainte de validation pour ce champ
                'required' => false
            ])
            ->add('ancienne_equipe', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'ancienne équipe est obligatoire'])
                ]
            ])
            ->add('nouvelle_equipe', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La nouvelle équipe est obligatoire']),
                    new Assert\Expression([
                        'expression' => 'value != this.getParent().get("ancienne_equipe").getData()',
                        'message' => 'La nouvelle équipe doit être différente de l\'ancienne équipe'
                    ])
                ]
            ])
            ->add('montantt', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le montant est obligatoire']),
                    new Assert\Positive(['message' => 'Le montant doit être positif']),
                    new Assert\Type([
                        'type' => 'float',
                        'message' => 'Le montant doit être un nombre décimal'
                    ])
                ]
            ])
            ->add('datet', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date est obligatoire']),
                    new Assert\LessThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date ne peut pas être dans le futur'
                    ])
                ]
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