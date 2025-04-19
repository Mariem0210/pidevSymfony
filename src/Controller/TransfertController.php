<?php

namespace App\Controller;

use App\Entity\Transfert;
use App\Form\TransfertType;
use App\Repository\TransfertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/transfert')]
final class TransfertController extends AbstractController
{
    #[Route(name: 'app_transfert_index', methods: ['GET'])]
    public function index(Request $request, TransfertRepository $transfertRepository): Response
    {
        $tri = $request->query->get('tri');

        if ($tri === 'montant') {
            $transferts = $transfertRepository->findBy([], ['montantt' => 'ASC']);
        } elseif ($tri === 'date') {
            $transferts = $transfertRepository->findBy([], ['datet' => 'ASC']);
        } else {
            $transferts = $transfertRepository->findAll();
        }

        return $this->render('transfert/index.html.twig', [
            'transferts' => $transferts,
        ]);
    }

    #[Route('/new', name: 'app_transfert_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transfert = new Transfert();
        $form = $this->createForm(TransfertType::class, $transfert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transfert);
            $entityManager->flush();

            return $this->redirectToRoute('app_transfert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transfert/new.html.twig', [
            'transfert' => $transfert,
            'form' => $form,
        ]);
    }

    #[Route('/{idtr}', name: 'app_transfert_show', methods: ['GET'])]
    public function show(Transfert $transfert): Response
    {
        return $this->render('transfert/show.html.twig', [
            'transfert' => $transfert,
        ]);
    }

    #[Route('/{idtr}/edit', name: 'app_transfert_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transfert $transfert, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TransfertType::class, $transfert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_transfert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transfert/edit.html.twig', [
            'transfert' => $transfert,
            'form' => $form,
        ]);
    }

    #[Route('/{idtr}', name: 'app_transfert_delete', methods: ['POST'])]
    public function delete(Request $request, Transfert $transfert, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transfert->getIdtr(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($transfert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transfert_index', [], Response::HTTP_SEE_OTHER);
    }
}
