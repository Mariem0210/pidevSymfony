<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commande')]
final class CommandeController extends AbstractController
{
    #[Route(name: 'app_commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id_commande}', name: 'app_commande_show', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/{id_commande}/edit', name: 'app_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id_commande}', name: 'app_commande_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId_commande(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/frontend/commande', name: 'app_commande_index_frontend', methods: ['GET'])]
    public function indexFrontend(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/frontend/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }
    
    #[Route('/frontend/commande/{id_commande}', name: 'app_commande_show_frontend', methods: ['GET'])]
    public function showFrontend(Commande $commande): Response
    {
        return $this->render('commande/frontend/show.html.twig', [
            'commande' => $commande,
        ]);
    }
    #[Route('/frontend/valider-panier', name: 'valider_panier', methods: ['POST', 'GET'])]
public function validerPanier(EntityManagerInterface $em, PanierRepository $panierRepo): Response
{
    $idu = 31; // ID utilisateur fixe

    // Récupérer tous les paniers pour cet utilisateur
    $paniers = $panierRepo->findBy(['idu' => $idu]);

    if (empty($paniers)) {
        $this->addFlash('error', 'Votre panier est vide.');
        return $this->redirectToRoute('app_panier_index_frontend');
    }

    // Calcul du montant total (exemple : 10dt par produit)
    $montantTotal = 0;
    foreach ($paniers as $panier) {
        $quantite = $panier->getQuantite() ?? 1;
        $montantTotal += $quantite * 10; // À adapter selon prix réel du produit
    }

    // Créer une nouvelle commande
    $commande = new Commande();
    $commande->setIdu($idu);
    $commande->setDateCommande(new \DateTime());
    $commande->setMontantTotal($montantTotal);

    $em->persist($commande);

    // Supprimer les paniers
    foreach ($paniers as $panier) {
        $em->remove($panier);
    }

    $em->flush();

    $this->addFlash('success', 'Commande validée avec succès !');
    return $this->redirectToRoute('app_commande_index_frontend');
}
}
