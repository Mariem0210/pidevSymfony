<?php

namespace App\Form;

use App\Entity\Certificat;
use App\Entity\Formation;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CertificatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomc', TextType::class, [
                'label' => 'Nom du certificat',
            ])
            ->add('typec', TextType::class, [
                'label' => 'Type de certificat',
            ])
            ->add('scorec', NumberType::class, [
                'label' => 'Score',
                'html5' => true,
                'scale' => 2,
            ])
            ->add('etatc', TextType::class, [
                'label' => 'État',
            ])
            ->add('dateExpirationc', DateType::class, [
                'label' => 'Date d\'expiration',
                'widget' => 'single_text',
            ])
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nomf',
                'label' => 'Formation',
                'placeholder' => 'Sélectionner une formation',
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function ($user) {
                    return $user->getNomu() . ' ' . $user->getPrenomu();
                },
                'placeholder' => 'Choisir un joueur',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('u')
                        ->where('u.typeu = :type')
                        ->setParameter('type', 'joueur');
                },
            ]);
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Certificat::class,
        ]);
    }
}
