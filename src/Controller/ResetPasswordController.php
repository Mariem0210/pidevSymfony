<?php
namespace App\Controller;

use App\Form\ResetPasswordRequestFormType;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    // Injection du service EntityManagerInterface via le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/reset-password", name="app_reset_password_request")
     */
    #[Route('/reset-password', name: 'app_reset_password_request')]
    public function request(Request $request)
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->getData()['mailu'];  // Utilisation du champ 'mailu'

            // Vérifier si l'email existe dans la base de données
            $user = $this->entityManager->getRepository(\App\Entity\Utilisateur::class)->findOneBy(['mailu' => $email]);

            if (!$user) {
                // Si l'email n'existe pas, afficher un message d'erreur
                $this->addFlash('error', 'No account found with this email address.');
                return $this->redirectToRoute('app_reset_password_request');
            }

            // Si l'email existe, rediriger vers le formulaire pour changer le mot de passe
            return $this->redirectToRoute('app_reset_password', ['email' => $email]);
        }

        return $this->render('reset_password/request.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reset-password/{email}", name="app_reset_password")
     */
    #[Route('/reset-password/{email}', name: 'app_reset_password')]
    public function resetPassword($email, Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        // Vérifier que l'utilisateur avec l'email existe
        $user = $this->entityManager->getRepository(\App\Entity\Utilisateur::class)->findOneBy(['mailu' => $email]);

        if (!$user) {
            $this->addFlash('error', 'No account found with this email address.');
            return $this->redirectToRoute('app_login');
        }

        // Créer le formulaire pour le nouveau mot de passe
        $form = $this->createFormBuilder()
            ->add('new_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, [
                'label' => 'New Password',
                'required' => true,
            ])
            ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, [
                'label' => 'Reset Password',
            ])
            ->getForm();

        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->getData()['new_password'];
            // Utilisation de la méthode hashPassword pour hacher le mot de passe
            $encodedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($encodedPassword);

            // Sauvegarder le nouveau mot de passe dans la base de données
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Password has been successfully updated.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/reset.html.twig', [
            'form' => $form->createView(),  // Passer le formulaire à la vue
            'email' => $email,  // Passer l'email à la vue pour l'afficher
        ]);
    }
}
