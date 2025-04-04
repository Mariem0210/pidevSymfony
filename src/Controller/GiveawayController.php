<?php

namespace App\Controller;

use App\Entity\Giveaway;
use App\Form\GiveawayType;
use App\Repository\GiveawayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/giveaway')]
final class GiveawayController extends AbstractController
{
    #[Route(name: 'app_giveaway_index', methods: ['GET'])]
    public function index(GiveawayRepository $giveawayRepository): Response
    {
        return $this->render('giveaway/index.html.twig', [
            'giveaways' => $giveawayRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_giveaway_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $giveaway = new Giveaway();
        $form = $this->createForm(GiveawayType::class, $giveaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($giveaway);
            $entityManager->flush();

            return $this->redirectToRoute('app_giveaway_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('giveaway/new.html.twig', [
            'giveaway' => $giveaway,
            'form' => $form,
        ]);
    }

    #[Route('/{idg}', name: 'app_giveaway_show', methods: ['GET'])]
    public function show(Giveaway $giveaway): Response
    {
        return $this->render('giveaway/show.html.twig', [
            'giveaway' => $giveaway,
        ]);
    }

    #[Route('/{idg}/edit', name: 'app_giveaway_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Giveaway $giveaway, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GiveawayType::class, $giveaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_giveaway_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('giveaway/edit.html.twig', [
            'giveaway' => $giveaway,
            'form' => $form,
        ]);
    }

    #[Route('/{idg}', name: 'app_giveaway_delete', methods: ['POST'])]
    public function delete(Request $request, Giveaway $giveaway, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$giveaway->getIdg(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($giveaway);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_giveaway_index', [], Response::HTTP_SEE_OTHER);
    }
}
