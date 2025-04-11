<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Repository\CertificatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
        
        $form = $this->createFormBuilder($certificat)
            ->add('nomc', TextType::class, [
                'label' => 'Nom du certificat',
                'attr' => ['class' => 'form-control']
            ])
            ->add('typec', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('scorec', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('etatc', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateExpirationc', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('idf', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'ID Formation'
            ])
            ->add('idu', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'ID Utilisateur'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($certificat);
            $entityManager->flush();

            return $this->redirectToRoute('app_certificat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('certificat/new.html.twig', [
            'certificat' => $certificat,
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
        $form = $this->createFormBuilder($certificat)
            ->add('nomc', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('typec', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('scorec', NumberType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('etatc', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateExpirationc', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('idf', IntegerType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('idu', IntegerType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_certificat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('certificat/edit.html.twig', [
            'certificat' => $certificat,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_certificat_delete', methods: ['POST'])]
    public function delete(Request $request, Certificat $certificat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificat->getIdc(), $request->request->get('_token'))) {
            $entityManager->remove($certificat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_certificat_index', [], Response::HTTP_SEE_OTHER);
    }
}