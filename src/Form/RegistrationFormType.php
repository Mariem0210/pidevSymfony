<?php
namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('mailu', EmailType::class, [
            'label' => 'Email address',
            'required' => true,
            'constraints' => [
                new NotBlank(['message' => 'L\'email est obligatoire']),
                new Email(['message' => 'Veuillez entrer un email valide'])
            ]
        ])
        ->add('nomu', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le nom est obligatoire']),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                    'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères'
                ]),
                // Contrainte Regex pour n'accepter que des lettres (pas de chiffres ou caractères spéciaux)
                new Regex([
                    'pattern' => '/^[a-zA-ZÀ-ÿ\s-]+$/',  // Permet les lettres et les espaces et tirets
                    'message' => 'Le nom ne doit contenir que des lettres, des espaces ou des tirets.'
                ])
            ]
        ])
        
        ->add('prenomu', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le prénom est obligatoire']),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                    'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères'
                ]),
                // Contrainte Regex pour n'accepter que des lettres (pas de chiffres ou caractères spéciaux)
                new Regex([
                    'pattern' => '/^[a-zA-ZÀ-ÿ\s-]+$/',  // Permet les lettres et les espaces et tirets
                    'message' => 'Le prénom ne doit contenir que des lettres, des espaces ou des tirets.'
                ])
            ]
        ])
        
            ->add('numtelu', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le numéro de téléphone est obligatoire']),
                    new Regex([
                        'pattern' => '/^[0-9]{8,15}$/',
                        'message' => 'Le numéro de téléphone doit être composé de 8 à 15 chiffres'
                    ])
                ]
            ])
            ->add('datenaissanceu', DateType::class, [
                'widget' => 'choice',  // Utilise des listes déroulantes pour jour, mois et année
                'years' => range(date('Y') - 100, date('Y') - 18), // Plage d'années allant de 100 ans avant l'année actuelle jusqu'à 18 ans avant l'année actuelle
                'constraints' => [
                    new NotBlank(['message' => 'La date de naissance est obligatoire']),
                    new \Symfony\Component\Validator\Constraints\LessThanOrEqual([
                        'value' => '-18 years',
                        'message' => 'Vous devez avoir au moins 18 ans'
                    ])
                ]
            ])
            
            ->add('typeu', ChoiceType::class, [
                'label' => 'Type d\'utilisateur',
                'choices' => [
                    'Administrateur' => 'ADMIN',
                    'Joueur' => 'JOUEUR',
                    'Coach' => 'COACH'
                ],
                'attr' => [
                    'class' => 'form-select' // Classe Bootstrap pour les listes déroulantes
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le type d\'utilisateur est obligatoire']),
                ]
            ])
            // Champ texte à la place de la checkbox "agreeTerms"
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer un mot de passe']),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
            // Champ upload image
            ->add('photo_profilu', FileType::class, [
                'label' => 'Photo de profil (JPG, PNG)',
                'mapped' => false, // car ce n'est pas une string directement dans l'objet (c'est un fichier)
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image JPG ou PNG',
                    ])
                ],
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
