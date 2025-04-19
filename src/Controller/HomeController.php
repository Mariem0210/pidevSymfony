<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\CertificatRepository;

class HomeController extends AbstractController
{
    #[Route("/home1", name: "app_home")]
   
    
    public function index(): Response
    {
        // You can pass data to your template here if needed
        return $this->render('home1.html.twig', [
            'controller_name' => 'HomeController',
            // Add any other variables you want to pass to the template
        ]);
    }
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(
        FormationRepository $formationRepository,
        UtilisateurRepository $utilisateurRepository,
        CertificatRepository $certificatRepository
    ): Response {
        return $this->render('base1.html.twig', [
            'formations_count' => $formationRepository->count([]),
            'utilisateurs_count' => $utilisateurRepository->count([]),
            'certificats_count' => $certificatRepository->count([]),
        ]);
    }
}
