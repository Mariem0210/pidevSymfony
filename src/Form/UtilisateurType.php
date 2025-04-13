<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomu', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom est obligatoire']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('prenomu', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom est obligatoire']),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('typeu', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le type d\'utilisateur est obligatoire']),
                    new Assert\Choice([
                        'choices' => ['admin', 'coach', 'joueur'],
                        'message' => 'Type d\'utilisateur invalide'
                    ])
                ]
            ])
            ->add('mailu', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'email est obligatoire']),
                    new Assert\Email(['message' => 'Veuillez entrer un email valide'])
                ]
            ])
            ->add('mdpu', PasswordType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le mot de passe est obligatoire']),
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('datenaissanceu', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de naissance est obligatoire']),
                    new Assert\LessThanOrEqual([
                        'value' => '-18 years',
                        'message' => 'Vous devez avoir au moins 18 ans'
                    ])
                ]
            ])
            ->add('dateinscriu', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date d\'inscription est obligatoire']),
                    new Assert\LessThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date d\'inscription ne peut pas être dans le futur'
                    ])
                ]
            ])
            ->add('numtelu', TelType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le numéro de téléphone est obligatoire']),
                    new Assert\Regex([
                        'pattern' => '/^[0-9]{8,15}$/',
                        'message' => 'Numéro de téléphone invalide'
                    ])
                ]
            ])
            ->add('photo_profilu', FileType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG ou GIF)',
                        'maxSizeMessage' => 'L\'image ne peut pas dépasser {{ limit }}'
                    ])
                ]
            ])
            ->add('reset_code', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 50,
                        'maxMessage' => 'Le code ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('code_expiration', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'constraints' => [
                    new Assert\GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date d\'expiration doit être aujourd\'hui ou dans le futur'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}