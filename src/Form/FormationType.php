<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomf')
            ->add('descriptionf')
            ->add('niveauf')
            ->add('dateDebut', DateType::class, ['widget' => 'single_text'])
            ->add('dateFin', DateType::class, ['widget' => 'single_text'])
            ->add('capacitef')
            ->add('prixf')
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'nomu',
                'placeholder' => 'Choisir un coach',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.typeu = :type')
                        ->setParameter('type', 'coach'); // changer selon besoin
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
