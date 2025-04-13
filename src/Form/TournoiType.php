<?php

namespace App\Form;

use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomt', TextType::class, [
                'label' => 'Nom du tournoi',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom est obligatoire.']),
                ],
            ])
            ->add('descriptiont', TextType::class, [
                'label' => 'Description',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La description est obligatoire.']),
                ],
            ])
            ->add('date_debutt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual([
                        'value' => (new \DateTime())->setTime(0, 0),
                        'message' => 'La date de début ne peut pas être dans le passé.',
                    ]),
                ],
            ])
            ->add('date_fint', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('nbr_equipes', IntegerType::class, [
                'label' => 'Nombre d\'équipes',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le nombre d\'équipes doit être supérieur ou égal à 0.',
                    ]),
                ],
            ])
            ->add('prixt', NumberType::class, [
                'label' => 'Prix',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le prix doit être supérieur ou égal à 0.',
                    ]),
                ],
            ])
            ->add('statutt', TextType::class, [
                'label' => 'Statut',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le statut est obligatoire.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
            'constraints' => [
                new Callback([$this, 'validateDates']),
            ],
        ]);
    }

    public function validateDates(Tournoi $tournoi, ExecutionContextInterface $context): void
    {
        $debut = $tournoi->getDateDebutt();
        $fin = $tournoi->getDateFint();

        if ($debut && $fin && $fin < $debut) {
            $context->buildViolation('La date de fin doit être postérieure à la date de début.')
                ->atPath('date_fint')
                ->addViolation();
        }
    }
}