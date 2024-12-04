<?php

namespace App\Controller;

use App\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarController extends AbstractController
{

    public function __construct(
        private readonly CarService $carService
    )
    {
    }

    #[Route(path: '/api/v1/cars/{id}', methods: ['GET'])]
    public function carById(int $id): Response
    {
        return $this->json($this->carService->getCarById($id));
    }
}
