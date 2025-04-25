<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/vehicle', name: 'vehicle.')]
class VehicleController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('vehicle/index.html.twig');
    }

    #[Route('', name: 'store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['plateNumber'] or $data['brand'])) {
            return new JsonResponse(['error' => 'Missing field'], 400);
        }

        $vehicle = new Vehicle(brand: $data['brand'], plate_number: $data['plateNumber']);
        $em->persist($vehicle);
        $em->flush();

        return new JsonResponse(['status' => 'ok', 'id' => $vehicle->getId()]);
    }
}
