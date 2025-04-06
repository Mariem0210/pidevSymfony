<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 🔑 Hachage du mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setMdpu($userPasswordHasher->hashPassword($user, $plainPassword));

            // 📷 Gestion de l'image
       // 📷 Gestion de l'image
$imageFile = $form->get('photo_profilu')->getData(); // Nom corrigé
if ($imageFile) {
    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
    $safeFilename = $slugger->slug($originalFilename);
    $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

  // 📷 Gestion de l'image
try {
    $imageFile->move(
        $this->getParameter('photos_directory'), // Nom du paramètre corrigé
        $newFilename
    );
} catch (FileException $e) {
    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
}

    $user->setPhotoProfilu($newFilename);
}

            // 📥 Sauvegarde en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // 🔄 Redirection vers la connexion
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
