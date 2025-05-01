<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManager;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/vehicle', name: 'vehicle.')]
class VehicleController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $em, VehicleRepository $vehicleRepository): Response
    {
        $page = max(1, $request->query->getInt('page', 1));
        $itemsPerPage = max(1, $request->query->getInt('itemsPerPage', 10));
        $sortBy = $request->query->get('sortBy', 'id');
        $sortDesc = filter_var($request->query->get('sortDesc', false), FILTER_VALIDATE_BOOLEAN);

        $offset = ($page - 1) * $itemsPerPage;

        $qb = $em->createQueryBuilder()
            ->select('v')
            ->from(Vehicle::class, 'v')
            ->orderBy('v.' . $sortBy, $sortDesc ? 'DESC' : 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage);

        $paginator = new Paginator($qb);

        $vehicles = [];
        foreach ($paginator as $vehicle) {
            $vehicles[] = [
                'plate_number' => $vehicle->getPlateNumber(),
                'brand' => $vehicle->getBrand(),
            ];
        }

        return new JsonResponse([
            'items' => $vehicles,
            'total' => count($paginator),
        ]);
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
