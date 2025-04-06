<?php

namespace App\Form;

use App\Entity\OffreDeRectrutement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreDeRectrutementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idu')
            ->add('poste_recherche')
            ->add('niveu_requis')
            ->add('salaire_propose')
            ->add('status')
            ->add('contrat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OffreDeRectrutement::class,
        ]);
    }
}
