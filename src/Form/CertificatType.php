<?php

namespace App\Form;

use App\Entity\Certificat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CertificatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idf', IntegerType::class, [
                'label' => 'ID Formation',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'identifiant de formation est obligatoire.']),
                    new Assert\Positive(['message' => 'L\'identifiant doit être positif.']),
                ],
            ])
            ->add('idu', IntegerType::class, [
                'label' => 'ID Utilisateur',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'identifiant utilisateur est obligatoire.']),
                    new Assert\Positive(['message' => 'L\'identifiant doit être positif.']),
                ],
            ])
            ->add('nomc', TextType::class, [
                'label' => 'Nom du certificat',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom est obligatoire.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('typec', TextType::class, [
                'label' => 'Type',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le type est obligatoire.']),
                    new Assert\Choice([
                        'choices' => ['technique', 'comportemental', 'participation'],
                        'message' => 'Type invalide.',
                    ]),
                ],
            ])
            ->add('scorec', IntegerType::class, [
                'label' => 'Score',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le score est obligatoire.']),
                    new Assert\Range([
                        'min' => 0,
                        'max' => 100,
                        'notInRangeMessage' => 'Doit être entre {{ min }} et {{ max }}.',
                        'invalidMessage' => 'Doit être un nombre.',
                    ]),
                ],
            ])
            ->add('etatc', TextType::class, [
                'label' => 'État',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'état est obligatoire.']),
                    new Assert\Choice([
                        'choices' => ['valide', 'expiré', 'en attente'],
                        'message' => 'État invalide.',
                    ]),
                ],
            ])
            ->add('dateExpirationc', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d\'expiration',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date est obligatoire.']),
                    new Assert\GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'Ne peut pas être dans le passé.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Certificat::class,
        ]);
    }
}