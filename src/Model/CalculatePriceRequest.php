<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
class CalculatePriceRequest
{
    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\Positive]
    public mixed $price;

    #[Assert\NotBlank]
    #[Assert\Type(type: "float")]
    #[Assert\GreaterThan(0)]
    public mixed $initialPayment;

    #[Assert\NotBlank]
    #[Assert\Type(type: "integer")]
    #[Assert\GreaterThan(0)]
    public mixed $loanTerm;

    public function __construct(mixed $price, mixed $initialPayment, mixed $loanTerm)
    {
        $this->price = $price;
        $this->initialPayment = $initialPayment;
        $this->loanTerm = $loanTerm;
    }


}
