<?php

namespace App\Form;

use App\Entity\Giveaway;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class GiveawayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreg', TextType::class, [
                'label' => 'Titre du giveaway',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le titre est obligatoire.']),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 100,
                        'minMessage' => 'Le titre doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le titre ne peut pas dépasser {{ limit }} caractères.'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Entrez le titre du giveaway'
                ]
            ])
            ->add('descg', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La description est obligatoire.']),
                    new Assert\Length([
                        'min' => 10,
                        'max' => 500,
                        'minMessage' => 'La description doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères.'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Décrivez le giveaway'
                ]
            ])
            ->add('datedg', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de début est obligatoire.']),
                    new Assert\GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date de début ne peut pas être dans le passé.'
                    ]),
                ],
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('datefg', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de fin est obligatoire.']),
                ],
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('statusg', TextType::class, [
                'label' => 'Statut',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le statut est obligatoire.']),
                    new Assert\Choice([
                        'choices' => ['actif', 'inactif', 'en attente', 'terminé'],
                        'message' => 'Statut invalide. Choisissez parmi: actif, inactif, en attente, terminé.'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Sélectionnez le statut'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Giveaway::class,
            'constraints' => [
                new Callback([$this, 'validateGiveawayDates'])
            ],
        ]);
    }

    public function validateGiveawayDates(Giveaway $giveaway, ExecutionContextInterface $context): void
    {
        if ($giveaway->getDatedg() && $giveaway->getDatefg()) {
            // Vérifie que la date de fin est après la date de début
            if ($giveaway->getDatefg() <= $giveaway->getDatedg()) {
                $context->buildViolation('La date de fin doit être postérieure à la date de début.')
                    ->atPath('datefg')
                    ->addViolation();
            }

            // Vérifie que la durée ne dépasse pas 1 an (365 jours)
            if ($giveaway->getDatedg()->diff($giveaway->getDatefg())->days > 365) {
                $context->buildViolation('Le giveaway ne peut pas durer plus d\'un an.')
                    ->atPath('datefg')
                    ->addViolation();
            }
        }
    }
}