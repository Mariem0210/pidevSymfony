<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Form\CertificatType;
use App\Repository\CertificatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/certificat')]
final class CertificatController extends AbstractController
{
    #[Route(name: 'app_certificat_index', methods: ['GET'])]
    public function index(CertificatRepository $certificatRepository): Response
    {
        return $this->render('certificat/index.html.twig', [
            'certificats' => $certificatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_certificat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $certificat = new Certificat();
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($certificat);
            $entityManager->flush();

            return $this->redirectToRoute('app_certificat_index');
        }

        return $this->render('certificat/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_certificat_show', methods: ['GET'])]
    public function show(Certificat $certificat): Response
    {
        return $this->render('certificat/show.html.twig', [
            'certificat' => $certificat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_certificat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Certificat $certificat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_certificat_index');
        }

        return $this->render('certificat/edit.html.twig', [
            'form' => $form->createView(),
            'certificat' => $certificat,
        ]);
    }

    #[Route('/{id}', name: 'app_certificat_delete', methods: ['POST'])]
    public function delete(Request $request, Certificat $certificat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $certificat->getIdc(), $request->request->get('_token'))) {
            $entityManager->remove($certificat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_certificat_index');
    }
    #[Route('/{id}/pdf', name: 'app_certificat_pdf', methods: ['GET'])]
    public function generatePdf(Certificat $certificat): Response
    {
        // 1. Options Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Pour charger les images (ex: background)
        $options->set('defaultFont', 'Arial');
    
        // 2. Création de Dompdf avec options
        $dompdf = new Dompdf($options);
    
        // 3. Rendu du HTML depuis Twig
        $html = $this->renderView('certificat/pdf.html.twig', [
            'certificat' => $certificat,
        ]);
    
        // 4. Générer le PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // ou portrait
        $dompdf->render();
    
        // 5. Retourner le PDF au navigateur (téléchargement direct)
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="certificat_' . $certificat->getIdc() . '.pdf"',
            ]
        );
    }

}
