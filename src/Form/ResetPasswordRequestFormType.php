<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Callback;

class ResetPasswordRequestFormType extends AbstractType
{
    private $entityManager;

    // Injection du EntityManagerInterface pour accéder à la base de données
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mailu', EmailType::class, [  // Utilisation de 'mailu' au lieu de 'email'
                'label' => 'Email Address',
                'attr' => [
                    'placeholder' => 'Enter your email address',
                    'class' => 'form_control'
                ],
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter your email address.',
                    ]),
                    new Assert\Email([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                    ]),
                    new Callback([$this, 'validateEmailExists'])  // Appel à la méthode de validation
                ]
            ]);
    }

    // Cette méthode vérifie si l'email existe déjà dans la base de données
    public function validateEmailExists($email, ExecutionContextInterface $context)
    {
        // Rechercher l'utilisateur avec l'email donné
        $user = $this->entityManager->getRepository(\App\Entity\Utilisateur::class)->findOneBy(['mailu' => $email]);
        // Recherche avec 'mailu'

        if (!$user) {
            // Si l'utilisateur n'est pas trouvé, on ajoute une erreur
            $context->buildViolation('This email address does not exist in our system.')
                ->atPath('mailu')  // L'erreur est attachée au champ 'mailu'
                ->addViolation();
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
