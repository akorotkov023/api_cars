<?php

namespace App\Controller;

use App\Model\CarDetails;
use App\Model\CarListResponse;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use App\Model\ErrorResponse;
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
    #[OA\Response(response: 200, description: 'Returns cars by id', attachables: [new Model(type: CarDetails::class)])]
    #[OA\Response(response: 404, description: 'book category not found', attachables: [new Model(type: ErrorResponse::class)])]
    public function carById(int $id): Response
    {
        return $this->json($this->carService->getCarById($id));
    }

    #[Route(path: '/api/v1/cars', methods: ['GET'])]
    #[OA\Response(response: 200, description: 'Returns cars', attachables: [new Model(type: CarListResponse::class)])]
    #[OA\Response(response: 404, description: 'book category not found', attachables: [new Model(type: ErrorResponse::class)])]
    public function cars(): Response
    {
        return $this->json($this->carService->getCars());
    }
}
