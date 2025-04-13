<?php

namespace App\Controller;

use App\Entity\OffreDeRectrutement;
use App\Form\OffreDeRectrutementType;
use App\Repository\OffreDeRectrutementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/offre/de/rectrutement')]
final class OffreDeRectrutementController extends AbstractController
{
    #[Route(name: 'app_offre_de_rectrutement_index', methods: ['GET'])]
    public function index(OffreDeRectrutementRepository $offreDeRectrutementRepository): Response
    {
        return $this->render('offre_de_rectrutement/index.html.twig', [
            'offre_de_rectrutements' => $offreDeRectrutementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offre_de_rectrutement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offreDeRectrutement = new OffreDeRectrutement();
        $form = $this->createForm(OffreDeRectrutementType::class, $offreDeRectrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offreDeRectrutement);
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_de_rectrutement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_de_rectrutement/new.html.twig', [
            'offre_de_rectrutement' => $offreDeRectrutement,
            'form' => $form,
        ]);
    }

    #[Route('/{ido}', name: 'app_offre_de_rectrutement_show', methods: ['GET'])]
    public function show(OffreDeRectrutement $offreDeRectrutement): Response
    {
        return $this->render('offre_de_rectrutement/show.html.twig', [
            'offre_de_rectrutement' => $offreDeRectrutement,
        ]);
    }

    #[Route('/{ido}/edit', name: 'app_offre_de_rectrutement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffreDeRectrutement $offreDeRectrutement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreDeRectrutementType::class, $offreDeRectrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_de_rectrutement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_de_rectrutement/edit.html.twig', [
            'offre_de_rectrutement' => $offreDeRectrutement,
            'form' => $form,
        ]);
    }

    #[Route('/{ido}', name: 'app_offre_de_rectrutement_delete', methods: ['POST'])]
    public function delete(Request $request, OffreDeRectrutement $offreDeRectrutement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offreDeRectrutement->getIdo(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($offreDeRectrutement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_de_rectrutement_index', [], Response::HTTP_SEE_OTHER);
    }
}
