<?php

namespace App\Controller;

use App\Model\CreditParamsRequest;
use App\Service\CreditService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class CreditController extends AbstractController
{
    #[Route(path: '/api/v1/credit/calculate', methods: ['GET'])]
    public function calcCredit(Request $request, CreditService $creditService): JsonResponse
    {
        return $creditService->calculateLoan($request);
    }

    #[Route(path: '/api/v1/request', methods: ['POST'], format: 'json')]
    public function calc(#[MapRequestPayload(
        acceptFormat: 'json',
        validationGroups: ['strict', 'read'],
        validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY
    )] CreditParamsRequest $creditParamsRequest, CreditService $creditService
    ): JsonResponse
    {
        return $creditService->save($creditParamsRequest);
    }

}
