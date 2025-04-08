<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/home", name: "app_home")]
   
    
    public function index(): Response
    {
        // You can pass data to your template here if needed
        return $this->render('home1.html.twig', [
            'controller_name' => 'HomeController',
            // Add any other variables you want to pass to the template
        ]);
    }
}