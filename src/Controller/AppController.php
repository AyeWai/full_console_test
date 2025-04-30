<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class AppController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
