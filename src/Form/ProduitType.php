<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('nom', TextType::class, [
            'constraints' => [
                new Regex([
                    'pattern' => '/^[a-zA-Z0-9\séèàçâêîôûù]+$/',
                    'message' => 'Caractères spéciaux non autorisés'
                ])
            ]
        ])
        ->add('prix', NumberType::class, [
            'scale' => 2,
            'attr' => ['min' => 0.01]
        ])
    
        ->add('description', TextareaType::class) // Make sure this exists
  
        
        ->add('stock', NumberType::class)
        
        // ... autres champs
        ->add('image_produit', FileType::class, [
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new Assert\File([
                    'maxSize' => '2M',
                    'mimeTypes' => ['image/jpeg', 'image/png'],
                    'mimeTypesMessage' => 'Seuls les JPG/PNG sont acceptés'
                ])
            ]
            
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}