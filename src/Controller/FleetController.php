<?php

namespace App\Controller;

use App\Entity\Fleet;
use App\Form\Fleet2Type;
use App\Repository\FleetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/fleet')]
final class FleetController extends AbstractController
{
    #[Route(name: 'app_fleet_index', methods: ['GET'])]
    public function index(FleetRepository $fleetRepository): Response
    {
        return $this->render('fleet/index.html.twig', [
            'fleets' => $fleetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fleet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FleetRepository $fleetRepository): Response
    {
        $fleet = new Fleet();
        $form = $this->createForm(Fleet2Type::class, $fleet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fleet);
            $entityManager->flush();

            return $this->redirectToRoute('app_fleet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fleet/new.html.twig', [
            'fleet' => $fleet,
            'form' => $form,
        ]);
        // return new JsonResponse([$vehicles]);
    }

    #[Route('/{id}', name: 'app_fleet_show', methods: ['GET'])]
    public function show(Fleet $fleet): Response
    {
        return $this->render('fleet/show.html.twig', [
            'fleet' => $fleet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fleet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fleet $fleet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Fleet2Type::class, $fleet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fleet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fleet/edit.html.twig', [
            'fleet' => $fleet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fleet_delete', methods: ['POST'])]
    public function delete(Request $request, Fleet $fleet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fleet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($fleet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fleet_index', [], Response::HTTP_SEE_OTHER);
    }
}
