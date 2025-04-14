<?php

namespace App\Controller;

use App\Entity\Utilisateur;

use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProfileController extends AbstractController
{
    /**
     * Route[("/profile/edit", name="app_profile_edit", methods={"GET", "POST"})}
     */
 
     #[Route('/profile/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
     public function edit(Request $request, EntityManagerInterface $entityManager): Response
     {
         // Get the current logged-in user
         $user = $this->getUser();
     
         // If the user is not logged in, redirect to the login page
         if (!$user) {
             return $this->redirectToRoute('app_login');
         }
     
         // Create the form and handle the request
         $form = $this->createForm(UtilisateurType::class, $user);
         $form->handleRequest($request);
     
         // If the form is submitted and valid
         if ($form->isSubmitted() && $form->isValid()) {
             // Handle profile picture upload
             $imageFile = $form->get('photo_profilu')->getData();
             if ($imageFile) {
                 $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                 $safeFilename = preg_replace('/[^A-Za-z0-9-]/', '', $originalFilename);  // Clean filename
                 $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
     
                 try {
                     // Move the file to the directory you want
                     $imageFile->move(
                         $this->getParameter('images_directory'), // Define this in services.yaml
                         $newFilename
                     );
     
                     // Set the filename in the user's profile
                     $user->setPhotoProfilu($newFilename);
                 } catch (FileException $e) {
                     // Handle the error
                     $this->addFlash('error', 'Failed to upload the image.');
                     return $this->redirectToRoute('app_profile_show');
                 }
             }
     
             // Persist changes to the database
             $entityManager->persist($user);
             $entityManager->flush();
     
             // Add a success message and redirect to the profile page
             $this->addFlash('success', 'Your profile has been updated successfully.');
             return $this->redirectToRoute('app_profile_show');
         }
     
         // Render the edit profile form if not submitted or errors occurred
         return $this->render('profile/edit.html.twig', [
             'form' => $form->createView(),
         ]);
     }
     

    

    /**
     * @Route("/profile", name="app_profile_show", methods={"GET"})
     */
    #[Route('/profile', name: 'app_profile_show', )]
    public function show(): Response
    {
        // Récupérer l'utilisateur actuel
        $user = $this->getUser();
        
        // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        if (!$user) { 
            return $this->redirectToRoute('app_login');
        }
        

        return $this->render('profile/show.html.twig', [
            'user' => $user,
        ]);
    }
}
