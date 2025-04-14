<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si l'utilisateur est déjà connecté, on le redirige
        if ($this->getUser()) {
            return $this->redirectToRoute($this->getRedirectRouteBasedOnUserType());
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $mailu = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'email' => $mailu,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut rester vide, la déconnexion est gérée par Symfony
    }

    /**
     * Détermine la route de redirection en fonction du type d'utilisateur (typeu)
     */
    private function getRedirectRouteBasedOnUserType(): string
    {
        $user = $this->getUser();
        
        // Vérifiez que l'utilisateur a bien une méthode getTypeu()
        if (!method_exists($user, 'getTypeu')) {
            throw new \LogicException('L\'utilisateur doit avoir une méthode getTypeu()');
        }
        
        $userType = $user->getRoles();
        
        // Redirection en fonction du type d'utilisateur
        switch ($userType) {
            case 'ADMIN':
                return 'app_utilisateur_index';
            case 'COACH':
                return 'app_home'; // Exemple pour les coachs
            case 'JOUEUR':
                return 'app_home'; // Exemple pour les joueurs
            default:
                return 'app_home';
        }
    }
}