<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_equipe', TextType::class, [
                'label' => 'Nom de l\'équipe',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le nom de l\'équipe est obligatoire.'
                    ]),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.'
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\-_]+$/',
                        'message' => 'Le nom ne peut contenir que des lettres, chiffres, espaces, tirets et underscores.'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Entrez le nom de l\'équipe'
                ]
            ])
            ->add('date_creation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de création',
                'data' => new \DateTime(),
                'html5' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'La date de création est obligatoire.'
                    ]),
                    new Assert\LessThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date de création ne peut pas être dans le futur.'
                    ])
                ],
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('idu', IntegerType::class, [
                'label' => 'ID du responsable',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'identifiant du responsable est obligatoire.'
                    ]),
                    new Assert\Positive([
                        'message' => 'L\'identifiant doit être un nombre positif.'
                    ]),
                    new Assert\Range([
                        'min' => 1,
                        'max' => 999999,
                        'notInRangeMessage' => 'L\'identifiant doit être entre {{ min }} et {{ max }}.'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'ID du responsable',
                    'min' => 1
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
            'constraints' => [
                new Callback([$this, 'validateEquipe'])
            ],
        ]);
    }

    public function validateEquipe(Equipe $equipe, ExecutionContextInterface $context): void
    {
        // Validation personnalisée supplémentaire si nécessaire
        // Exemple: vérifier que l'ID utilisateur existe en base de données
        
        if ($equipe->getDateCreation() > new \DateTime('+1 day')) {
            $context->buildViolation('La date de création ne peut pas être plus d\'un jour dans le futur.')
                ->atPath('date_creation')
                ->addViolation();
        }
    }
}