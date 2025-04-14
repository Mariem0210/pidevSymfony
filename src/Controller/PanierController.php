<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Form\PanierType;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panier')]
final class PanierController extends AbstractController
{
    #[Route(name: 'app_panier_index', methods: ['GET'])]
    public function index(PanierRepository $panierRepository): Response
    {
        return $this->render('panier/index.html.twig', [
            'paniers' => $panierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_panier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $panier = new Panier();
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/new.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{id_panier}', name: 'app_panier_show', methods: ['GET'])]
    public function show(Panier $panier): Response
    {
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/{id_panier}/edit', name: 'app_panier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/edit.html.twig', [
            'panier' => $panier,
            'form' => $form,
        ]);
    }

    #[Route('/{id_panier}', name: 'app_panier_delete', methods: ['POST'])]
    public function delete(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId_panier(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/ajouter-au-panier/{id}', name: 'ajouter_au_panier', methods: ['POST'])]
public function ajouterAuPanier(int $id, EntityManagerInterface $em): Response
{
    $panier = new Panier();
    $panier->setIdu(31); // ID utilisateur fixe
    $panier->setIdProduit($id);
    $panier->setQuantite(1);
    $panier->setDateAjout(new \DateTime());

    $em->persist($panier);
    $em->flush();

    return $this->redirectToRoute('app_produit_index_frontend');
}
#[Route('/frontend/panier', name: 'app_panier_index_frontend', methods: ['GET'])]
public function indexFrontend(PanierRepository $panierRepository): Response
{
    return $this->render('panier/frontend/index.html.twig', [
        'paniers' => $panierRepository->findAll(),
    ]);
}

#[Route('/frontend/panier/{id_panier}', name: 'app_panier_show_frontend', methods: ['GET'])]
public function showFrontend(Panier $panier): Response
{
    return $this->render('panier/frontend/show.html.twig', [
        'panier' => $panier,
    ]);
}

}

