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
         // Récupérer l'utilisateur connecté
         $user = $this->getUser();
     
         // Redirection si non connecté
         if (!$user) {
             return $this->redirectToRoute('app_login');
         }
     
         // Créer et gérer le formulaire
         $form = $this->createForm(UtilisateurType::class, $user);
         $form->handleRequest($request);
     
         if ($form->isSubmitted() && $form->isValid()) {
             // Persister les changements
             $entityManager->flush();
     
             // Rediriger vers la page profil
             return $this->redirectToRoute('app_profile_show', [], Response::HTTP_SEE_OTHER);
         }
     
         // Rendu du formulaire
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
