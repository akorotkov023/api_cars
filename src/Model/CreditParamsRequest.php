<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
class CreditParamsRequest
{
    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\Positive]
    public mixed $carId;

    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\Positive]
    public mixed $programId;

    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\Positive]
    public mixed $initialPayment;

    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\Positive]
    public mixed $loanTerm;

    public function __construct(mixed $carId, mixed $programId, mixed $initialPayment, mixed $loanTerm)
    {
        $this->carId = $carId;
        $this->programId = $programId;
        $this->initialPayment = $initialPayment;
        $this->loanTerm = $loanTerm;
    }

}
