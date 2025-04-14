<?php

namespace App\Form;

use App\Entity\OffreDeRectrutement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

class OffreDeRectrutementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idu', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'identifiant utilisateur est obligatoire']),
                    new Assert\Positive(['message' => 'L\'identifiant doit être un nombre positif'])
                ]
            ])
            ->add('poste_recherche', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le poste recherché est obligatoire']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'Le poste doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Le poste ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('niveu_requis', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le niveau requis est obligatoire']),
                    new Assert\Length([
                        'max' => 50,
                        'maxMessage' => 'Le niveau requis ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('salaire_propose', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le salaire proposé est obligatoire']),
                    new Assert\Positive(['message' => 'Le salaire doit être un nombre positif'])
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Ouvert' => 'ouvert',
                    'Fermé' => 'ferme',
                    'En cours' => 'en_cours'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le statut est obligatoire'])
                ]
            ])
            ->add('contrat', ChoiceType::class, [
                'choices' => [
                    'CDI' => 'cdi',
                    'CDD' => 'cdd',
                    'Stage' => 'stage',
                    'Alternance' => 'alternance'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le type de contrat est obligatoire'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OffreDeRectrutement::class,
        ]);
    }
}