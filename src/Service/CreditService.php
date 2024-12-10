<?php

namespace App\Service;

use App\Entity\Credit;
use App\Exception\CarNotFoundException;
use App\Exception\CreditProgramNotFoundException;
use App\Model\CalculatePriceRequest;
use App\Repository\CarRepository;
use App\Repository\CreditProgramRepository;
use App\Service\Validator\CarValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class CreditService
{
    public function __construct(
        private CarRepository $carRepository,
        private CreditProgramRepository $creditProgramRepository,
        private EntityManagerInterface $em,
        private CarValidator $validatorService
    ){}

    public function calculateLoan($request): JsonResponse
    {
        $model = new CalculatePriceRequest(
            (int)$request->query->get('price') ?? null,
            (float)$request->query->get('initialPayment') ?? null,
            (int)$request->query->get('loanTerm')) ?? null;

        $this->validatorService->validate($model);

        //TODO переделать по условию кредитные программы должны храниться в БД
        $loanAmount = $model->price - $model->initialPayment;
        $programId = uniqid();

        if ($model->initialPayment > 200000 && $model->loanTerm < 60) {
            $interestRate = 0.123; // 12.3%
            $monthlyPayment = round(($loanAmount * $interestRate / 12) / (1 - (1 + $interestRate / 12) ** (-$model->loanTerm)));
            $title = "Premium Credit Program";
        } else {
            $interestRate = 0.15; // 15%
            $monthlyPayment = round(($loanAmount * $interestRate / 12) / (1 - (1 + $interestRate / 12) ** (-$model->loanTerm)));
            $title = "Standard Credit Program";
        }

        return new JsonResponse([
            'programId' => $programId,
            'interestRate' => round($interestRate * 100, 1),
            'monthlyPayment' => $monthlyPayment,
            'title' => $title,
        ], Response::HTTP_OK);
    }


    public function save($creditParamsRequest): JsonResponse
    {
        $this->validatorService->valid($creditParamsRequest);

        $car = $this->carRepository->find($creditParamsRequest->carId);
        if (!$car) {
            throw new CarNotFoundException();
        }

        $program = $this->creditProgramRepository->find($creditParamsRequest->programId);
        if (!$program) {
            throw new CreditProgramNotFoundException();
        }

        $credit = new Credit();
        $credit
            ->setCarId($car)
            ->setProgramId($program)
            ->setInitialPayment($creditParamsRequest->initialPayment)
            ->setLoanTerm($creditParamsRequest->loanTerm);

        $this->em->persist($credit);
        $this->em->flush();

        return new JsonResponse(['success' => true], Response::HTTP_OK);
    }

}
