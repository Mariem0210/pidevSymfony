<?php

namespace App\Form;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_panier')
            ->add('quantite')
            ->add('date_ajout', null, [
                'widget' => 'single_text',
            ])
            ->add('idu', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'id',
            ])
            ->add('id_produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Panier::class,
        ]);
    }
}
