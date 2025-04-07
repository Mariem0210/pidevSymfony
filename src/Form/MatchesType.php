<?php

namespace App\Form;

use App\Entity\Matches;
use App\Entity\Tournoi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;

class MatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('equipe1', null, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'équipe 1 est obligatoire']),
                ]
            ])
            ->add('equipe2', null, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'équipe 2 est obligatoire']),
                ]
            ])
            ->add('date_debutm', null, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(['message' => 'La date de début est obligatoire']),
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date ne peut pas être dans le passé'
                    ])
                ],
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d')
                ]
            ])
            ->add('status', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Le statut est obligatoire']),
                ]
            ])
            ->add('score', IntegerType::class, [
                'constraints' => [
                    new PositiveOrZero(['message' => 'Le score ne peut pas être négatif']),
                    new Range([
                        'min' => 0,
                        'max' => 100,
                        'notInRangeMessage' => 'Le score doit être entre {{ min }} et {{ max }}'
                    ])
                ],
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('tournoi', EntityType::class, [
                'class' => Tournoi::class,
                'choice_label' => 'id',
                'constraints' => [
                    new NotBlank(['message' => 'Le tournoi est obligatoire']),
                ]
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